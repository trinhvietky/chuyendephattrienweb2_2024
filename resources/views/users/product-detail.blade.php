@extends('users/app')
@section('title', 'Product-Detail')
@section('menu-footer')
<meta charset="UTF-8">

<!-- breadcrumb -->
<div class="container" style="margin-top: 100px;">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
			Men
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			{{$product->product_name}}
		</span>
	</div>
</div>


<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-7 p-b-30">
				<div class="p-l-25 p-r-30 p-lr-0-lg">
					<div class="wrap-slick3 flex-sb flex-w">
						<div class="wrap-slick3-dots"></div>
						<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

						<div class="slick3 gallery-lb">
							@foreach ($product->images as $image) <!-- Lặp qua các hình ảnh -->
							<div class="item-slick3" data-thumb="{{ asset($image->image_path) }}">
								<div class="wrap-pic-w pos-relative">
									<img src="{{ asset($image->image_path) }}" alt="IMG-PRODUCT">

									<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset($image->image_path) }}">
										<i class="fa fa-expand"></i>
									</a>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-lg-5 p-b-30">
				<div class="p-r-50 p-t-5 p-lr-0-lg">
					<h4 class="mtext-105 cl2 js-name-detail p-b-14" style="text-transform: uppercase">
						{{ strtoupper($product->product_name) }}
					</h4>

					<span class="mtext-106 cl2">
						{{ number_format($product->price, 0, ',', '.') }}đ
					</span>

					<!--  -->
					<div class="p-t-33">
						<div class="flex-w flex-r-m p-b-10">
							<div class="size-203 flex-c-m respon6" style="display: flex; justify-content: flex-start;">
								Color
							</div>

							<div class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<!-- Select for Color -->
									<select class="js-select2" name="color" id="colorSelect" style="width: 100%;">
										<option value="">Choose a color</option>
										@foreach ($product->productVariants->unique('color_id') as $variant)
										<option value="{{ $variant->color->id }}">
											Color {{ $variant->color->color_name }}
										</option>
										@endforeach
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
						</div>


						<div class="flex-w flex-r-m p-b-10">
							<div class="size-203 flex-c-m respon6" style="display: flex; justify-content: flex-start;">
								Size
							</div>

							<div class="size-204 respon6-next">
								<div class="rs1-select2 bor8 bg0">
									<select class="js-select2" name="size" id="sizeSelect" style="width: 100%;">
										<option value="">Choose a size</option>
										@foreach ($product->productVariants->unique('size_id') as $variant)
										<option value="{{ $variant->size->id }}" data-quantity="{{ $variant->stock}}">
											{{ $variant->size->size_name }}
										</option>
										@endforeach
									</select>

									<div class="dropDownSelect2"></div>
								</div>
							</div>
						</div>

						<div class="flex-w flex-r-m p-b-10">
							<div class="size-203 flex-c-m respon6" style="display: flex; justify-content: flex-start;">
								Số lượng
							</div>
							<div class="size-204 respon6-next">
								<p id="quantityDisplay">0</p>
							</div>
						</div>

						<div class="flex-w flex-r-m p-b-10">
							<div class="size-204 flex-w flex-m respon6-next">
								<div class="wrap-num-product flex-w m-r-20 m-tb-10">
									<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
										<i class="fs-16 zmdi zmdi-minus"></i>
									</div>

									<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="0" data-max-quantity="10">

									<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
										<i class="fs-16 zmdi zmdi-plus"></i>
									</div>
								</div>

								<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
									Add to cart
								</button>
							</div>
						</div>
					</div>

					<!--  -->
					<div class="flex-w flex-m p-l-100 p-t-40 respon7">
						<div class="flex-m bor9 p-r-10 m-r-11">
							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
								<i class="zmdi zmdi-favorite"></i>
							</a>
						</div>

						<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
							<i class="fa fa-twitter"></i>
						</a>

						<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
							<i class="fa fa-google-plus"></i>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="bor10 m-t-50 p-t-43 p-b-40">
			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item p-b-10">
						<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
					</li>

					<li class="nav-item p-b-10">
						<a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
					</li>

					<li class="nav-item p-b-10">
						<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-43">
					<!-- - -->
					<div class="tab-pane fade show active" id="description" role="tabpanel">
						<div class="how-pos2 p-lr-15-md">
							<p class="stext-102 cl6">
								{{$product->description}}
							</p>
						</div>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="information" role="tabpanel">
						<div class="row">
							<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
								<table>
									<thead>
										<tr>
											<th>Size name</th>
											<th>Weight (kg)</th>
											<th>Height (cm)</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>S</td>
											<td>40 - 50</td>
											<td>150 - 160</td>
										</tr>
										<tr>
											<td>M</td>
											<td>50 - 60</td>
											<td>160 - 170</td>
										</tr>
										<tr>
											<td>L</td>
											<td>60 - 70</td>
											<td>170 - 180</td>
										</tr>
										<tr>
											<td>XL</td>
											<td>70 - 80</td>
											<td>180 - 190</td>
										</tr>
										<tr>
											<td>XXL</td>
											<td>80 - 90</td>
											<td>190 - 200</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="reviews" role="tabpanel">
						<div class="row">
							<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
								<div class="p-b-30 m-lr-15-sm">
									<!-- Review -->
									<div class="flex-w flex-t p-b-68">
										<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
											<img src="images/avatar-01.jpg" alt="AVATAR">
										</div>

										<div class="size-207">
											<div class="flex-w flex-sb-m p-b-17">
												<span class="mtext-107 cl2 p-r-20">
													Ariana Grande
												</span>

												<span class="fs-18 cl11">
													<i class="zmdi zmdi-star"></i>
													<i class="zmdi zmdi-star"></i>
													<i class="zmdi zmdi-star"></i>
													<i class="zmdi zmdi-star"></i>
													<i class="zmdi zmdi-star-half"></i>
												</span>
											</div>

											<p class="stext-102 cl6">
												Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
											</p>
										</div>
									</div>

									<!-- Add review -->
									<form class="w-full">
										<h5 class="mtext-108 cl2 p-b-7">
											Add a review
										</h5>

										<p class="stext-102 cl6">
											Your email address will not be published. Required fields are marked *
										</p>

										<div class="flex-w flex-m p-t-50 p-b-23">
											<span class="stext-102 cl3 m-r-16">
												Your Rating
											</span>

											<span class="wrap-rating fs-18 cl11 pointer">
												<i class="item-rating pointer zmdi zmdi-star-outline"></i>
												<i class="item-rating pointer zmdi zmdi-star-outline"></i>
												<i class="item-rating pointer zmdi zmdi-star-outline"></i>
												<i class="item-rating pointer zmdi zmdi-star-outline"></i>
												<i class="item-rating pointer zmdi zmdi-star-outline"></i>
												<input class="dis-none" type="number" name="rating">
											</span>
										</div>

										<div class="row p-b-25">
											<div class="col-12 p-b-5">
												<label class="stext-102 cl3" for="review">Your review</label>
												<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
											</div>

											<div class="col-sm-6 p-b-5">
												<label class="stext-102 cl3" for="name">Name</label>
												<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
											</div>

											<div class="col-sm-6 p-b-5">
												<label class="stext-102 cl3" for="email">Email</label>
												<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
											</div>
										</div>

										<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
											Submit
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
		<span class="stext-107 cl6 p-lr-25">
			SKU: JAK-01   
		</span>

		<span class="stext-107 cl6 p-lr-25">
			Categories: Jacket, Men
		</span>
	</div>
</section>


<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
	<div class="container">
		<div class="p-b-45">
			<h3 class="ltext-106 cl5 txt-center">
				Related Products
			</h3>
		</div>

		<!-- Slide2 -->
		<div class="wrap-slick2">
			<div class="slick2">
				@foreach ($relatedProducts as $index => $relatedProduct)
				<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="{{ isset($relatedImages[$index]) ? asset($relatedImages[$index]->image_path) : asset('default-image-path.jpg') }}" alt="IMG-PRODUCT">

							<a href="{{ route('users/product-detail', ['product_id' => $relatedProduct->product_id]) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
								Quick View
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									{{ $relatedProduct->product_name }}
								</a>

								<span class="stext-105 cl3">
									{{ number_format($relatedProduct->price, 0, ',', '.') }} đ
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="/images/icons/icon-heart-01.png" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="/images/icons/icon-heart-02.png" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</div>
</section>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		let sizeSelected = false; // Biến kiểm tra đã chọn size chưa
		// Gắn sự kiện khi người dùng thay đổi size
		document.getElementById('sizeSelect').addEventListener('change', updateQuantity);
		// Gắn sự kiện khi người dùng thay đổi số lượng qua nút cộng và trừ
		document.querySelector('.btn-num-product-down').addEventListener('click', changeQuantity);
		document.querySelector('.btn-num-product-up').addEventListener('click', changeQuantity);
		// Gắn sự kiện khi người dùng thay đổi số lượng trong input
		document.querySelector('input[name="num-product"]').addEventListener('input', checkQuantity);

		// Đặt số lượng khởi đầu
		var input = document.querySelector('input[name="num-product"]');
		input.value = 0;

		// Cập nhật số lượng tồn kho khi người dùng chọn size
		function updateQuantity() {
			var sizeSelect = document.getElementById('sizeSelect');
			var selectedSize = sizeSelect.options[sizeSelect.selectedIndex];
			var sizeQuantity = selectedSize ? selectedSize.getAttribute('data-quantity') : 0;

			// Cập nhật số lượng tối đa cho input
			var input = document.querySelector('input[name="num-product"]');
			input.setAttribute('data-max-quantity', sizeQuantity);

			// Hiển thị số lượng tồn kho
			document.getElementById('quantityDisplay').innerText = sizeQuantity;

			// Đặt lại giá trị về 0 khi thay đổi size
			input.value = 0;

			sizeSelected = true; // Đánh dấu đã chọn size
		}

		// Thay đổi số lượng khi người dùng nhấn nút cộng hoặc trừ
		function changeQuantity(event) {
			event.preventDefault(); // Ngăn ngừa sự kiện mặc định
			var sizeSelect = document.getElementById('sizeSelect');
			var input = document.querySelector('input[name="num-product"]');
			var maxQuantity = parseInt(input.getAttribute('data-max-quantity'), 10);
			var currentQuantity = parseInt(input.value, 10);

			// Kiểm tra nếu chưa chọn size
			if (!sizeSelected) {
				alert("Vui lòng chọn kích cỡ trước khi thay đổi số lượng!");
				return; // Kết thúc hàm để ngăn tăng/giảm
			}

				if (event.target.classList.contains('btn-num-product-up')) {
					// Chỉ tăng 1 đơn vị nếu không vượt quá số lượng kho
					if (currentQuantity < maxQuantity) {
						input.value = currentQuantity; // Tăng 1 đơn vị
					}
				}
				// Kiểm tra nút trừ
				else if (event.target.classList.contains('btn-num-product-down')) {
					// Chỉ giảm 1 đơn vị nếu giá trị không nhỏ hơn 0
					if (currentQuantity > 0) {
						input.value = currentQuantity; // Giảm 1 đơn vị
					}
				}

			// Kiểm tra nút cộng


			checkQuantity(); // Kiểm tra lại số lượng sau khi thay đổi
		}

		// Kiểm tra số lượng sau khi thay đổi và hiển thị thông báo nếu cần
		function checkQuantity() {
			var input = document.querySelector('input[name="num-product"]');
			var currentQuantity = parseInt(input.value, 10);
			var maxQuantity = parseInt(input.getAttribute('data-max-quantity'), 10);

			// Kiểm tra nếu giá trị nhỏ hơn 0, đặt lại giá trị về 0
			if (currentQuantity <= 0) {
				alert('Số lượng không thể nhỏ hơn hoặc bằng 0');
				input.value = 1;
			}

			// Kiểm tra nếu giá trị vượt quá số lượng tồn kho
			if (currentQuantity > maxQuantity) {
				alert('Số lượng không thể vượt quá số lượng trong kho!');
				input.value = maxQuantity; // Đặt lại giá trị về số lượng tồn kho tối đa
			}
		}
	});
</script>


@endsection()