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
									<input class="form-check-input ml-auto" checked type="radio" name="shipping" id="shipping1">
									<label class="form-check-label" for="shipping1">
										Giao hàng tận nơi - 30.000đ
									</label>
								</div>

								<h5 class="card-title mt-3">Thanh toán</h5>
								<div class="form-check mb-2">
									<input class="form-check-input ml-auto" checked type="radio" name="payment" id="cod">
									<label class="form-check-label" for="cod">
										Thanh toán khi nhận hàng - COD
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input ml-auto" type="radio" name="payment" id="transfer">
									<label class="form-check-label" for="transfer">
										Chuyển khoản
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="card mt-4">
					<div class="card-body">
						<h5 class="card-title">Thông tin nhận hàng</h5>
						<div class="form-check mb-2">
							<input class="form-check-input ml-auto" type="radio" name="address" id="address1">
							<label class="form-check-label" for="address1">
								1. Đường Võ Văn Ngân, Phường Trường Thọ, Quận Thủ Đức, Hồ Chí Minh
							</label>
						</div>
						<div class="form-check mb-2">
							<input class="form-check-input ml-auto" type="radio" name="address" id="address2">
							<label class="form-check-label" for="address2">
								2. Đường Võ Văn Ngân, Phường Trường Thọ, Quận Thủ Đức, Hồ Chí Minh
							</label>
						</div>
						<textarea class="form-control mb-3" rows="3" placeholder="Ghi chú"></textarea>
						<a href="#" class="text-primary">Thêm địa chỉ mới</a>
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
						<div class="input-group mb-3 ">
							<input type="text" class="form-control mr-4" placeholder="Nhập mã giảm giá">
							<button class="btn btn-primary">Áp dụng</button>
						</div>
						<div class="d-flex justify-content-between mb-2">
							<p>Tạm tính:</p>
							<p>{{ number_format($total , 0, ',', '.')}}</p>
						</div>
						<div class="d-flex justify-content-between mb-2">
							<p>Phí vận chuyển:</p>
							<p>30.000đ</p>
						</div>
						<div class="d-flex justify-content-between">
							<strong>Tổng cộng:</strong>
							<strong>{{ number_format($total + 30000 , 0, ',', '.') }}</strong>
						</div>
						<button class="btn btn-success mt-3">Đặt hàng</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection