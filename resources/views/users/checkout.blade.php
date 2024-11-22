@extends('users/app')
@section('menu-footer')
<style>
	.image-placeholder {
		width: 50px;
		height: 50px;
		background-color: #e9ecef;
		display: flex;
		justify-content: center;
		align-items: center;
		border-radius: 4px;
		font-size: 12px;
		color: #6c757d;
	}

	.card-title {
		font-size: 18px;
		font-weight: bold;
	}

	textarea {
		resize: none;
	}

	.btn-primary {
		background-color: #007bff;
		border-color: #007bff;
	}

	.btn-primary:hover {
		background-color: #0056b3;
	}

	.btn-success {
		background-color: #28a745;
		border-color: #28a745;
	}

	.btn-success:hover {
		background-color: #218838;
	}

	.custom-container {
		max-width: 1280px;
		padding: 0 15px;
		margin: 0 auto;
	}

	input {
		width: 100%;
		padding: 10px;
		border: 1px solid #ddd;
		border-radius: 4px;
		margin-top: 5px;
	}

	.position-relative {
		position: relative;
	}

	.quantity-overlay {
		position: absolute;
		top: -8px;
		left: 40px;
		color: white;
		font-size: 12px;
		padding: 3px 9px;
		border-radius: 50%;
		font-weight: bold;
	}
</style>

<div class="bg0 m-t-23 p-b-140" style="margin-top: 100px;">
	<div class="custom-container mt-5">
		<div class="row">
			<!-- Thông tin khách hàng -->
			<div class="col-md-7 mb-4">
				<div class="row">
					<div class="col-md-7">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Thông tin khách hàng</h5>
								<form>
									<div class="mb-3">
										<label for="email" class="form-label">Email</label>
										<input type="email" class="form-control" id="email" value="{{Auth::user()->email}}" placeholder="Nhập email">

									</div>
									<div class="mb-3">
										<label for="name" class="form-label">Họ và tên</label>
										<input type="text" class="form-control" id="name" value="{{Auth::user()->name}}" placeholder="Nhập họ và tên">

									</div>
									<div class="mb-3">
										<label for="phone" class="form-label">Số điện thoại</label>
										<input type="tel" class="form-control" id="phone" value="{{Auth::user()->phone}}" placeholder="Nhập số điện thoại">

									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="card ">
							<div class="card-body">
								<h5 class="card-title">Vận chuyển</h5>
								<div class="form-check mb-2">
									<input class="form-check-input ml-auto" checked type="radio" name="shipping" value="0" id="shipping1">
									<label class="form-check-label" for="shipping1">
										Giao hàng tận nơi - 30.000đ
									</label>
								</div>

								<h5 class="card-title mt-3">Thanh toán</h5>
								<div class="form-check mb-2">
									<input class="form-check-input ml-auto" checked type="radio" name="payment" value="0" id="cod">
									<label class="form-check-label" for="cod">
										Thanh toán khi nhận hàng - COD
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input ml-auto" type="radio" name="payment" value="1" id="transfer">
									<label class="form-check-label" for="transfer">
										Chuyển khoản
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="address-container" class="card mt-4">
					<!-- Giao diện ban đầu -->
					<div class="card-body" id="address-list">
						<h5 class="card-title">Thông tin nhận hàng</h5>
						@foreach($listAddress as $address)
						<div class="form-check mb-2">
							<input class="form-check-input ml-auto" type="radio" name="address" id="address{{ $address->id }}" value="{{ $address->id }}">
							<label class="form-check-label" for="address{{ $address->id }}">
								{{ implode(', ', [$address->address, $address->phuong, $address->quan, $address->tinh]) }}
							</label>
						</div>
						@endforeach
						<textarea class="form-control mb-3" rows="3" placeholder="Ghi chú"></textarea>
						<a href="#" id="add-new-address" class="text-primary">Thêm địa chỉ mới</a>
					</div>
					<div id="add-address-form" class="card-body" style="display: none;">
						<h5 class="card-title">Thêm địa chỉ mới</h5>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Tỉnh/Thành</label>
									<select id="tinh" name="tinh" class="form-control" required>
										<option value="0">Chọn Tỉnh/Thành</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Quận huyện</label>
									<select id="quan" name="quan" class="form-control" required>
										<option value="0">Chọn Quận/Huyện</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Phường/Xã</label>
									<select id="phuong" name="phuong" class="form-control" required>
										<option value="0">Chọn Phường/Xã</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="street">Số nhà, đường</label>
									<input id="address" class="form-control" type="text" placeholder="Nhập số nhà, đường">
								</div>
							</div>
						</div>
						<textarea class="form-control mb-3" rows="3" placeholder="Ghi chú"></textarea>
						<a href="#" id="select-address" class="text-primary">Chọn từ sổ địa chỉ</a>
					</div>
				</div>


			</div>

			<!-- Đơn hàng -->
			<div class="col-md-5">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Đơn hàng ({{$totalQuantity}} sản phẩm)</h5>
						<?php $total = 0; ?>
						@foreach($carts as $index => $cart)
						<div class="d-flex justify-content-start align-items-center mb-3 position-relative">
							<img class="image-placeholder" src="{{ asset($images[$index]->image_path) }}" alt="Product Image">
							<span class="quantity-overlay bg-primary">
								{{$cart->quantity}}
							</span>
							<div class="mb-0 ml-5 mr-auto">
								<p>{{$cart->productVariant->product->product_name}}</p>
								<p>{{ $cart->productVariant->color->color_name }} / {{ $cart->productVariant->size->size_name }}</p>
							</div>
							<span>{{ number_format($cart->productVariant->product->price * $cart->quantity , 0, ',', '.') }}đ</span>
						</div>

						<?php
						$total += $cart->productVariant->product->price * $cart->quantity;
						?>
						@endforeach
						<div class="input-group mb-3">
							<input type="text" id="voucher-code" class="form-control mr-4" placeholder="Nhập mã giảm giá">
							<button id="apply-voucher" class="btn btn-primary">Áp dụng</button>
						</div>

						<!-- Hiển thị danh sách giá trị -->
						<div id="order-summary">
							<div class="d-flex justify-content-between mb-2">
								<p>Tạm tính:</p>
								<p data-value="{{ $total }}" id="subtotal">{{ number_format($total , 0, ',', '.')}}đ</p>
							</div>
							<div class="d-flex justify-content-between mb-2">
								<p>Phí vận chuyển:</p>
								<p>30.000đ</p>
							</div>
							<div class="d-flex justify-content-between" id="total-row">
								<strong>Tổng cộng:</strong>
								<strong id="total-amount">{{ number_format($total + 30000 , 0, ',', '.') }}đ</strong>
							</div>
							<!-- Dòng này sẽ được thêm khi mã giảm giá hợp lệ -->
						</div>
						<button class="btn btn-success mt-3" id="place-order">Đặt hàng</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="/js-home/apiJquery.js"></script>
<script>
	$(document).ready(function() {

		window.onload = function() {
			// Thêm 2 trạng thái vào lịch sử trình duyệt ngay khi tải trang
			history.pushState(null, null, window.location.href);
			history.pushState(null, null, window.location.href);

			// Lắng nghe sự kiện popstate (sự kiện khi người dùng nhấn nút quay lại)
			window.onpopstate = function(event) {
				// Khi sự kiện popstate xảy ra (người dùng nhấn nút back), thay thế lịch sử và giữ người dùng trên trang hiện tại
				history.pushState(null, null, window.location.href); // Đẩy trạng thái mới vào lịch sử
			};
		};

		const addressList = document.getElementById('address-list');
		const addAddressForm = document.getElementById('add-address-form');
		const addNewAddressBtn = document.getElementById('add-new-address');
		const selectAddressBtn = document.getElementById('select-address');


		// Hiển thị form "Thêm địa chỉ mới"
		addNewAddressBtn.addEventListener('click', function(e) {
			e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
			addressList.style.display = 'none';
			addAddressForm.style.display = 'block';
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
		});

		// Quay lại "Thông tin nhận hàng"
		selectAddressBtn.addEventListener('click', function(e) {
			e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
			addAddressForm.style.display = 'none';
			addressList.style.display = 'block';
		});

		// Chuyển sang template thêm địa chỉ
		const addNewAddress = $('#add-new-address').on('click', function(event) {
			event.preventDefault();
			const template = $('#new-address-template').html(); // Lấy nội dung template
			$('#address-container').html(template); // Thay thế nội dung của container

		});


		$('#apply-voucher').on('click', function() {
			const voucherCode = $('#voucher-code').val().trim();
			const cartTotal = parseFloat($('#subtotal').data('value')); // Lấy giá trị tổng tiền từ HTML

			if (!voucherCode) {
				alert('Vui lòng nhập mã giảm giá!');
				return;
			}

			// Gửi yêu cầu tới backend
			$.ajax({
				url: '/apply-voucher',
				method: 'POST',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				},
				data: {
					voucher: voucherCode,
					cart_total: cartTotal, // Truyền tổng tiền giỏ hàng
				},
				success: function(response) {
					if (response.success) {
						const discount = response.discount; // Số tiền giảm giá
						let newTotal = response.newTotal; // Tổng tiền mới
						newTotal += 30000;
						// Thêm dòng giảm giá
						const discountRow = `
                        <div class="d-flex justify-content-between mb-2">
                            <p>Giảm giá:</p>
                            <p>-${discount.toLocaleString() + 'đ'}</p>
                        </div>
                    `;


						// Xóa các dòng cũ và cập nhật
						$('#order-summary').find('.discount-row').remove();
						$('#order-summary').find('#total-row').before(discountRow);
						$('#total-amount').text(newTotal.toLocaleString() + 'đ');
					} else {
						alert(response.message || 'Mã giảm giá không hợp lệ!');
					}
				},
				error: function() {
					alert('Đã xảy ra lỗi, vui lòng thử lại sau!');
				},
			});
		});



		$('#place-order').on('click', function(event) {
			event.preventDefault(); // Ngừng gửi form mặc định

			// Lấy thông tin khách hàng
			const email = $('#email').val();
			const name = $('#name').val();
			const phone = $('#phone').val();

			// Lấy thông tin vận chuyển
			const shippingMethod = $('input[name="shipping"]:checked').val();
			const paymentMethod = $('input[name="payment"]:checked').val();

			const note = $('textarea').val().trim();


			// Lấy thông tin mã giảm giá (nếu có)
			const voucherCode = $('#voucher-code').val().trim();

			// Lấy tổng tiền (đã tính mã giảm giá và phí vận chuyển)
			let amountText = document.getElementById('total-amount').innerText;

			const totalAmount = parseFloat(amountText.replace('.', '').replace('đ', ''));

			let address = $('#address').val();
			let tinh = $('#tinh option:selected').text();
			let quan = $('#quan option:selected').text();
			let phuong = $('#phuong option:selected').text();

			const carts = <?php echo $carts ?>;


			// Nếu chưa có sự kiện click, thay đổi nội dung thành "b"
			const addressId = $('input[name="address"]:checked').val();

			console.log(email, name, phone, shippingMethod, paymentMethod, note, voucherCode, totalAmount, carts, addressId);
			console.log(tinh, quan, phuong, address);



			// // Kiểm tra thông tin cần thiết
			// if (!email || !name || !phone || !addressId) {
			// 	alert('Vui lòng điền đầy đủ thông tin!');
			// 	return;
			// }


			// Gửi dữ liệu tới backend qua AJAX
			$.ajax({
				url: '/payment', // Đảm bảo URL chính xác
				method: 'POST',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				},
				data: {
					email: email,
					name: name,
					phone: phone,
					shippingMethod: shippingMethod,
					paymentMethod: paymentMethod,
					note: note,
					voucherCode: voucherCode,
					totalAmount: totalAmount,
					carts: JSON.stringify(carts),
					addressId: addressId,
					tinh: tinh,
					quan: quan,
					phuong: phuong,
					address: address
				},
				success: function(response) {
					if (response.success) {
						console.log(response.payment_url);

						// location.href = response.payment_url;
					} else {
						alert("Order creation failed: " + response.message);
					}
				},
				error: function(response) {
					console.error('AJAX error:', response);
					alert('An error occurred. Please try again.');
				}
			});
		});
		// Ngăn không cho người dùng quay lại trang trước khi thanh toán

	});
</script>
@endsection