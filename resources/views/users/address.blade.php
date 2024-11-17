<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Địa chỉ mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
        }

        .header-form .container {
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .header-form h3 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #888;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .form-control,
        .form-select {
            border: none;
            border-bottom: 1px solid #ddd;
            border-radius: 0;
            padding-left: 0;
            padding-right: 0;
            box-shadow: none;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: none;
            border-color: #ff4500;
        }

        .btn-group {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
        }

        .btn-outline-secondary {
            color: #333;
            border-color: #ddd;
            border-radius: 15px;
            width: 45%;
        }

        .btn-outline-secondary.active {
            background-color: #ff4500;
            color: #fff;
            border-color: #ff4500;
        }

        .form-check-input {
            margin-top: 8px;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #333;
            cursor: pointer;
        }

        .submit-btn {
            background-color: #ddd;
            color: #bbb;
            font-weight: bold;
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            cursor: not-allowed;
            margin-top: 20px;
        }

        .submit-btn.active {
            background-color: #ff4500;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="header-form">
        <div class="container">
            <h3>Địa chỉ mới</h3>

            <form action="{{route('address.edit')}}" method="POST">
                @csrf
                <!-- Liên hệ Section -->
                <div>
                    <p class="section-title">Liên hệ</p>
                    <input type="text" id="name" name="name" class="form-control mb-3" placeholder="Họ và tên" required>
                    <input type="text" id="phone" name="phone" class="form-control mb-3" placeholder="Số điện thoại" required>
                </div>

                <!-- Địa chỉ Section -->
                <div>
                    <p class="section-title">Địa chỉ</p>
                    <select id="tinh" name="tinh" class="form-select mb-3" title="Chọn Tỉnh Thành" required>
                        <option value="0">Chọn Tỉnh/Thành phố</option>
                    </select>

                    <select id="quan" name="quan" class="form-select mb-3" required>
                        <option value="0">Chọn Quận/Huyện</option>
                    </select>

                    <select id="phuong" name="phuong" class="form-select mb-3" required>
                        <option value="0">Chọn Phường/Xã</option>
                    </select>
                    <input type="text" id="address" name="address" class="form-control mb-3" placeholder="Tên đường, Tòa nhà, Số nhà" required>
                </div>

                <!-- Cài đặt Section -->
                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="is_default" name="is_default" value="1">
                    <label class="form-check-label" for="is_default">
                        <p style="margin-top: 6px;">Đặt làm địa chỉ mặc định</p>
                    </label>
                </div>

                <!-- Nút Hoàn Thành -->
                <button type="submit" id="submitBtn" class="submit-btn" disabled>HOÀN THÀNH</button>

            </form>
        </div>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="/js-home/apiJquery.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch provinces
            $.getJSON('/js-home/api/data.json', function(data_tinh) {
                if (data_tinh.error === 0) {
                    $.each(data_tinh.data, function(key_tinh, val_tinh) {
                        $("#tinh").append('<option value="' + val_tinh.id + '">' + val_tinh.full_name + '</option>');
                    });

                    // Fetch districts on province change
                    $("#tinh").change(function() {
                        let idtinh = $(this).val();
                        let selectedProvince = data_tinh.data.find(function(item) {
                            return item.id === idtinh;
                        });

                        if (selectedProvince) {
                            $("#quan").html('<option value="0">Quận Huyện</option>');
                            $("#phuong").html('<option value="0">Phường Xã</option>');

                            $.each(selectedProvince.data2, function(key_quan, val_quan) {
                                $("#quan").append('<option value="' + val_quan.id + '">' + val_quan.full_name + '</option>');
                            });

                            // Fetch wards on district change
                            $("#quan").change(function() {
                                let idquan = $(this).val();
                                let selectedDistrict = selectedProvince.data2.find(function(item) {
                                    return item.id === idquan;
                                });

                                if (selectedDistrict) {
                                    $("#phuong").html('<option value="0">Phường Xã</option>');
                                    $.each(selectedDistrict.data3, function(key_phuong, val_phuong) {
                                        $("#phuong").append('<option value="' + val_phuong.id + '">' + val_phuong.full_name + '</option>');
                                    });
                                }
                            });
                        }
                    });
                }
            });

            // Display selected address and send data to the server
            $('#submitBtn').click(function() {
                let name = $('#name').val();
                let phone = $('#phone').val();
                let address = $('#address').val();
                let tinh = $('#tinh option:selected').text();
                let quan = $('#quan option:selected').text();
                let phuong = $('#phuong option:selected').text();
                let is_default = $('#is_default').is(':checked') ? '1' : '0';

                $.ajax({
                    type: 'POST',
                    url: '{{ route("address.save") }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        phone: phone,
                        address: address,
                        tinh: tinh,
                        quan: quan,
                        phuong: phuong,
                        is_default: is_default
                    },
                    success: function(response) {
                        alert(response);
                        location.reload(); // Reload the page to see the updated address list
                    },
                    error: function() {
                        alert("Có lỗi xảy ra khi lưu địa chỉ.");
                    }
                });
            });
            // Kích hoạt nút hoàn thành khi có đầy đủ thông tin
            document.querySelectorAll('.form-control, .form-select').forEach(input => {
                input.addEventListener('input', checkFormCompletion);
            });

            function checkFormCompletion() {
                const name = document.getElementById('name').value;
                const phone = document.getElementById('phone').value;
                const province = document.getElementById('tinh').value;
                const district = document.getElementById('quan').value;
                const ward = document.getElementById('phuong').value;
                const address = document.getElementById('address').value;

                const submitBtn = document.getElementById('submitBtn');
                if (name && phone && province && district && ward && address) {
                    submitBtn.classList.add('active');
                    submitBtn.disabled = false;
                } else {
                    submitBtn.classList.remove('active');
                    submitBtn.disabled = true;
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>