<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Address</title>
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

            /* Cải tiến đường viền, padding và margin của các phần tử */
            .form-control {
                border-radius: 12px;
                padding: 12px;
                font-size: 16px;
                background-color: #f9f9f9;
                border: 1px solid #ddd;
                transition: border-color 0.3s ease;
            }

            .form-control:focus {
                border-color: #e53935;
            }

            .form-check-label {
                font-size: 14px;
                color: #555;
            }

            /* Buttons */
            .btn {
                font-size: 16px;
                padding: 12px;
                border-radius: 12px;
                font-weight: 600;
            }

            /* Button Sizes */
            .w-100 {
                width: 100%;
            }

            /* Hover Effects */
            .btn:hover,
            .address-item:hover {
                transform: scale(1.02);
            }

            /* Responsive Styles */
            @media (max-width: 768px) {
                .address-page {
                    padding: 15px;
                }

                .modal-content {
                    max-width: 100%;
                }
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


        <!-- Modal -->
        <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAddressModalLabel">Chỉnh sửa địa chỉ</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editAddressForm" method="POST" action="{{ route("address.update") }}">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="address_id" name="address_id">

                            <div class="row">
                                <!-- Họ và tên -->
                                <div class="col-md-6 mb-3">
                                    <label for="edit_name" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="edit_name" name="name" required>
                                </div>

                                <!-- Số điện thoại -->
                                <div class="col-md-6 mb-3">
                                    <label for="edit_phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="edit_phone" name="phone" required>
                                </div>

                                <!-- Địa chỉ -->
                                <div class="col-md-12 mb-3">
                                    <label for="edit_address" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="edit_address" name="address" required>
                                </div>

                                <!-- Địa chỉ để thay đổi -->
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
                                </div>
                            </div>

                            <div>
                                <!-- Xóa địa chỉ -->
                                <div class="col-md-12 mb-3">
                                    <button type="button" id="deleteAddressBtn" class="btn btn-danger w-100">Xóa địa chỉ</button>
                                </div>

                                <!-- Mặc định -->
                                <div class="col-md-12 mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="edit_is_default" name="is_default">
                                    <label class="form-check-label" for="edit_is_default">Đặt làm mặc định</label>
                                </div>

                                <!-- Cập nhật -->
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>

    <script src="/js-home/apiJquery.js"></script>
    <script>
        $(document).ready(function() {
            // Khi một địa chỉ được chọn để chỉnh sửa
            $('.address-item').on('click', function() {
                var addressId = $(this).data('id');
                var addressName = $(this).data('name');
                var addressPhone = $(this).data('phone');
                var addressDetail = $(this).data('address');
                var addressPhuong = String($(this).data('phuong')); // Convert to string
                var addressQuan = String($(this).data('quan')); // Convert to string
                var addressTinh = String($(this).data('tinh')); // Convert to string
                var isDefault = $(this).data('default');

                // Cập nhật giá trị trong modal
                $('#address_id').val(addressId);
                $('#edit_name').val(addressName);
                $('#edit_phone').val(addressPhone);
                $('#edit_address').val(addressDetail);

                // Fetch dữ liệu tỉnh, quận, phường từ API
                $.getJSON('/js-home/api/tinh.json', function(data_tinh) {
                    if (data_tinh.error === 0) {
                        // Cập nhật các tỉnh vào dropdown
                        $('#tinh').html(`<option selected>${addressTinh}</option>`);
                        $.each(data_tinh.data, function(key_tinh, val_tinh) {
                            $("#tinh").append('<option value="' + val_tinh.id + '">' + val_tinh.full_name + '</option>');
                        });

                        // Thiết lập giá trị đã chọn cho tỉnh
                        $('#tinh').val(addressTinh).trigger('change'); // Trigger lại sự kiện change để load quận

                        // Fetch quận khi tỉnh thay đổi
                        $("#tinh").change(function() {
                            let idtinh = $(this).val();
                            if (idtinh) {
                                $('#quan').html(`<option selected>${addressQuan}</option>`);
                                $('#phuong').html(`<option selected>${addressPhuong}</option>`);
                                $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(data_quan) {
                                    if (data_quan.error === 0) {
                                        $('#quan').html(`<option selected>${addressQuan}</option>`);
                                        $('#phuong').html(`<option selected>${addressPhuong}</option>`);
                                        $.each(data_quan.data, function(key_quan, val_quan) {
                                            $("#quan").append('<option value="' + val_quan.id + '">' + val_quan.full_name + '</option>');
                                        });

                                        // Thiết lập quận đã chọn
                                        $('#quan').val(addressQuan).trigger('change'); // Trigger lại sự kiện change để load phường
                                    }
                                });
                            } else {
                                $("#quan").html('<option value="0">Chọn Quận/Huyện</option>');
                                $("#phuong").html('<option value="0">Chọn Phường/Xã</option>');
                            }
                        });

                        // Fetch phường khi quận thay đổi
                        $("#quan").change(function() {
                            let idquan = $(this).val();
                            if (idquan) {
                                $.getJSON('https://esgoo.net/api-tinhthanh/3/' + idquan + '.htm', function(data_phuong) {
                                    if (data_phuong.error === 0) {
                                        $('#phuong').html(`<option selected>${addressPhuong}</option>`);
                                        $.each(data_phuong.data, function(key_phuong, val_phuong) {
                                            $("#phuong").append('<option value="' + val_phuong.id + '">' + val_phuong.full_name + '</option>');
                                        });

                                        // Thiết lập phường đã chọn
                                        $('#phuong').val(addressPhuong);
                                    }
                                });
                            } else {
                                $("#phuong").html('<option value="0">Chọn Phường/Xã</option>');
                            }
                        });

                        // Set lại giá trị tỉnh, quận, phường đã chọn
                        $('#tinh').val(addressTinh).trigger('change');
                        $('#quan').val(addressQuan).trigger('change');
                    }
                });
                $('#edit_is_default').prop('checked', isDefault);

                // Mở modal
                var myModal = new bootstrap.Modal(document.getElementById('editAddressModal'));
                myModal.show();
            });
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

            // Get the address ID from a hidden field or data attribute
            let addressId = $('#address_id').val(); // This should be hidden in your form

            // Send the updated data to the server using AJAX
            $.ajax({
                type: 'POST',
                url: '{{ route("address.update") }}', // Use your update route here
                data: {
                    _token: '{{ csrf_token() }}',
                    id: addressId, // Include the ID of the address to update
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
                    alert("Có lỗi xảy ra khi cập nhật địa chỉ.");
                }
            });
        });
        $(document).ready(function() {
            // Gắn sự kiện cho nút "Xóa"
            $('#deleteAddressBtn').click(function() {
                if (confirm("Bạn có chắc chắn muốn xóa địa chỉ này không?")) {
                    let addressId = $('#address_id').val();

                    $.ajax({
                        type: 'DELETE',
                        url: '{{ route("address.destroy") }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            address_id: addressId
                        },
                        success: function(response) {
                            alert(response.message);
                            location.reload(); // Tải lại trang để cập nhật danh sách địa chỉ
                        },
                        error: function() {
                            alert("Có lỗi xảy ra khi xóa địa chỉ.");
                        }
                    });
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>