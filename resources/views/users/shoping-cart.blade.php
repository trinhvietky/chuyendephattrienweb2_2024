	@extends('users/app')
	@section('menu-footer')
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg mt-5">
			<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shoping Cart
			</span>
		</div>
	</div>


	<!-- Shoping Cart -->

	<div class="container bg0 p-t-75 p-b-85">
		<div class="row">
			<div class="col-lg-10 col-xl-8 m-lr-auto m-b-50">
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<!-- Container for the table with scroll -->
					<div class="wrap-table-shopping-cart">
						<div class="table-shopping-cart-container">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1" style="padding-left: 20px;">
										<input type="checkbox" id="select-all" style="appearance:auto"> <!-- Checkbox chọn tất cả -->
									</th>
									<th class="column-2 ">Product</th>
									<th class="column-3 text-center"></th>
									<th class="column-4 text-center">Price</th>
									<th class="column-5 text-center">Quantity</th>
									<th class="column-6 text-center">Total</th>
									<th class="column-7 text-center" style="width: 60px;"></th>
								</tr>
								<tbody class="table-body">
									<?php $cartTotal = 0 ?>
									@foreach($carts as $index =>$cart)
									<?php $cartTotal += $cart->productVariant->product->price * $cart->quantity; ?>
									<tr class="table_row">
										<td class="column-1" style="padding-left: 20px;">
											<input type="checkbox" class="select-item" style="appearance:auto" data-index="{{ $index }}">
										</td>
										<td class="column-2 ">
											<div class="how-itemcart1">
												<img src="{{asset($images[$index]->image_path)}}" alt="IMG">
											</div>
										</td>
										<td class="column-3 text-start" style="width: 25rem;">
											<p>{{ $cart->productVariant->product->product_name }}</p>
											<p>{{ $cart->productVariant->color->color_name }} / {{ $cart->productVariant->size->size_name }}</p>
										</td>
										<td class="column-4 price text-center">{{number_format($cart->productVariant->product->price)}}</td>
										<td class="column-5 text-center">
											<div class="wrap-num-product flex-w m-l-auto m-r-0">
												<div class="btn-num-product-down  cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-minus"></i>
												</div>

												<input class="mtext-104 cl3 txt-center num-product num-product-cart" type="number" name="num-product1" value="{{$cart->quantity}}" data-cart-id="{{ $cart->cart_id }}">

												<div class="btn-num-product-up   cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-plus"></i>
												</div>
											</div>
										</td>
										<td class="column-6 total text-center" data-cart-id="{{ $cart->cart_id }}">{{ number_format($cart->productVariant->product->price * $cart->quantity) }}</td>
										<td class="column-7 text-center">
											<form action="{{route('shoping-cart.destroy', ['id' => $cart->cart_id]) }}" method="POST" style="margin-right: 5px;">
												@csrf
												@method('DELETE')
												<button data-toggle="tooltip" title="Trash" class="pd-setting-ed btn-delete p-4" style="background: none; border: none;">
													<i class="zmdi zmdi-delete"></i>
												</button>
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-10 col-lg-7 col-xl-4 m-lr-auto m-b-50">
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
					<h4 class="mtext-109 cl2 p-b-30">
						Cart Totals
					</h4>


					<div class="flex-w flex-t p-t-27 p-b-33">
						<div class="size-208">
							<span class="mtext-101 cl2">
								Total:
							</span>
						</div>

						<div class="size-209 p-t-1">
							<span class="mtext-110 cl2" id="cart-total">
								{{ number_format($cartTotal) }}
							</span>
						</div>
					</div>

					<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
						Checkout
					</button>
				</div>
			</div>
		</div>
	</div>

	@endsection