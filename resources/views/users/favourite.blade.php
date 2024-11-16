@extends('users/app')

@section('menu-footer')
<div class="container" style="margin-top: 200px;">
	<div class="row isotope-grid">
		@foreach ($favourites as $index => $favourite)
		{{-- Lấy sản phẩm từ bảng products --}}
		@php
		$product = \App\Models\Product::find($favourite->product_id); // Tìm sản phẩm theo product_id
		$image = $images[$index]; // Lấy hình ảnh tương ứng với sản phẩm
		@endphp

		@if ($product && $image) {{-- Kiểm tra nếu sản phẩm và hình ảnh tồn tại --}}
		<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
			<!-- Block2 -->
			<div class="block2">
				<div class="block2-pic hov-img0">
					<img src="{{ $images[$index]->image_path }}" alt="IMG-PRODUCT"> {{-- Hiển thị hình ảnh sản phẩm --}}
					<a href="#"
						class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
						Quick View
					</a>
				</div>

				<div class="block2-txt flex-w flex-t p-t-14">
					<div class="block2-txt-child1 flex-col-l">
						<a href=""
							class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
							{{ $product->product_name }} {{-- Hiển thị tên sản phẩm --}}
						</a>

						<span class="stext-105 cl3">
							${{ number_format($product->price, 2) }} {{-- Hiển thị giá sản phẩm --}}
						</span>
					</div>

					<div class="block2-txt-child2 flex-r p-t-3">
						<a href="javascript:void(0)" data-product-id="{{ $product->product_id }}"
							class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
							<img class="icon-heart1 dis-block trans-04" src="/images/icons/icon-heart-01.png"
								alt="ICON">
							<img class="icon-heart2 dis-block trans-04 ab-t-l" src="/images/icons/icon-heart-02.png"
								alt="ICON">
						</a>
					</div>
				</div>
			</div>
		</div>
		@endif
		@endforeach
	</div>
</div>
@endsection