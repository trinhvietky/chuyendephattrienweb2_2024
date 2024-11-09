<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
<section>
    
    <style>
        /* Custom CSS for Address List */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .address-page {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .address-page .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .address-page .header h2 {
            font-size: 22px;
            color: #333;
        }

        .address-page .address-list {
            padding: 15px 0;
        }

        .address-page .address-item {
            border-bottom: 1px solid #eee;
            padding: 15px 15px;
            transition: background-color 0.2s;
            cursor: pointer;
        }

        .address-page .address-item:hover {
            background-color: #f0f0f0;
        }

        .address-page .address-item:last-child {
            border-bottom: none;
        }

        .address-page .address-header {
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 16px;
            color: #444;
        }

        .address-page .separator {
            margin: 0 5px;
            color: #888;
        }

        .address-page .address-phone {
            color: #888;
        }

        .address-page .address-details {
            color: #555;
            margin-top: 5px;
        }

        .address-page .default-tag {
            display: inline-block;
            padding: 3px 6px;
            margin-top: 8px;
            font-size: 12px;
            color: #e53935;
            border: 1px solid #e53935;
            border-radius: 3px;
            background-color: rgba(229, 57, 53, 0.1);
        }

        .address-page .add-address-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            color: #e53935;
            font-size: 16px;
            cursor: pointer;
            border-top: 1px solid #eee;
        }

        .address-page .add-address-btn button {
            width: 25px;
            height: 25px;
            border: 1px solid #e53935;
            border-radius: 50%;
            background-color: white;
            cursor: pointer;
        }

        .address-page .add-address-btn button:hover {
            background-color: #e53935;
            color: white;
        }

        .modal-content {
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

        .header-form .form-control,
        .header-form .form-select {
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

    <header class="header">
        <h2 class="text-lg font-medium text-gray-900">{{ __('Địa chỉ của tôi') }}</h2>
        <p class="mt-1 text-sm text-gray-600">{{ __("Có thể thay đổi được địa chỉ") }}</p>
    </header>

    <div class="address-page">
    <div class="address-list">
        @foreach ($addresses as $address)
            <div class="address-item"
                data-id="{{ $address->id }}"
                data-name="{{ $address->name }}"
                data-phone="{{ $address->phone }}"
                data-address="{{ $address->address }}"
                data-phuong="{{ $address->phuong }}"
                data-quan="{{ $address->quan }}"
                data-tinh="{{ $address->tinh }}"
                data-default="{{ $address->is_default }}">
                <div class="address-header">
                    <div class="address-name">{{ $address->name }}</div>
                    <span class="separator">|</span>
                    <div class="address-phone">{{ $address->phone }}</div>
                </div>
                <div class="address-details">
                    {{ $address->address }}<br>
                    Phường {{ $address->phuong }}, Quận {{ $address->quan }}, Tỉnh {{ $address->tinh }}
                </div>
                @if ($address->is_default)
                    <div class="default-tag">Mặc định</div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="add-address-btn">
        <a href="{{ route('users/address') }}" style="text-decoration: none; color: #e53935;">
            <button>+</button>
            Thêm địa chỉ mới
        </a>
    </div>
</div>


    <!-- Modal Edit Address -->
<div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="editAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAddressModalLabel">Chỉnh sửa địa chỉ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAddressForm" method="POST" action="{{ route('address.update') }}">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="address_id" name="address_id">

                    <div class="form-group">
                        <label for="edit_name">Họ và tên</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_phone">Số điện thoại</label>
                        <input type="text" class="form-control" id="edit_phone" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_address">Địa chỉ</label>
                        <input type="text" class="form-control" id="edit_address" name="address" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_tinh">Tỉnh</label>
                        <input type="text" class="form-control" id="edit_tinh" name="tinh" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_quan">Quận</label>
                        <input type="text" class="form-control" id="edit_quan" name="quan" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_phuong">Phường</label>
                        <input type="text" class="form-control" id="edit_phuong" name="phuong" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_is_default">Mặc định</label>
                        <input type="checkbox" id="edit_is_default" name="is_default">
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>

</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- <script>
        $(document).ready(function() {
            // Fetch provinces
            $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(data_tinh) {
                if (data_tinh.error === 0) {
                    $.each(data_tinh.data, function(key_tinh, val_tinh) {
                        $("#tinh").append('<option value="' + val_tinh.id + '">' + val_tinh.full_name + '</option>');
                    });

                    // Fetch districts on province change
                    $("#tinh").change(function() {
                        let idtinh = $(this).val();
                        $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(data_quan) {
                            if (data_quan.error === 0) {
                                $("#quan").html('<option value="0">Quận Huyện</option>');
                                $("#phuong").html('<option value="0">Phường Xã</option>');
                                $.each(data_quan.data, function(key_quan, val_quan) {
                                    $("#quan").append('<option value="' + val_quan.id + '">' + val_quan.full_name + '</option>');
                                });

                                // Fetch wards on district change
                                $("#quan").change(function() {
                                    let idquan = $(this).val();
                                    $.getJSON('https://esgoo.net/api-tinhthanh/3/' + idquan + '.htm', function(data_phuong) {
                                        if (data_phuong.error === 0) {
                                            $("#phuong").html('<option value="0">Phường Xã</option>');
                                            $.each(data_phuong.data, function(key_phuong, val_phuong) {
                                                $("#phuong").append('<option value="' + val_phuong.id + '">' + val_phuong.full_name + '</option>');
                                            });
                                        }
                                    });
                                });
                            }
                        });
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
                let is_default = $('#is_default').is(':checked'); // Checkbox for default address

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
                input.addEventListener('input', () => {
                    checkFormCompletion();
                });
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
    </script> -->

<script>
    $(document).ready(function() {
        // Khi một địa chỉ được chọn để chỉnh sửa
        $('.address-item').on('click', function() {
            var addressId = $(this).data('id');
            var addressName = $(this).data('name');
            var addressPhone = $(this).data('phone');
            var addressDetail = $(this).data('address');
            var addressPhuong = $(this).data('phuong');
            var addressQuan = $(this).data('quan');
            var addressTinh = $(this).data('tinh');
            var isDefault = $(this).data('default');

            // Cập nhật giá trị trong modal
            $('#address_id').val(addressId);
            $('#edit_name').val(addressName);
            $('#edit_phone').val(addressPhone);
            $('#edit_address').val(addressDetail);
            $('#edit_phuong').val(addressPhuong);
            $('#edit_quan').val(addressQuan);
            $('#edit_tinh').val(addressTinh);
            $('#edit_is_default').prop('checked', isDefault);

            // Mở modal
            var myModal = new bootstrap.Modal(document.getElementById('editAddressModal'));
            myModal.show();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>