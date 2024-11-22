@extends('users/app')
@section('title', 'Search')
@section('menu-footer')

<!-- Product -->
<div class="bg0 m-t-23 p-b-140" style="margin-top: 100px;">
	<div class="container">
		<div class="flex-w flex-sb-m p-b-52">
			<div class="flex-w flex-l-m filter-tope-group m-tb-10">
			<a class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ request()->is('product') ? 'how-active1' : '' }}"
					href="{{ route('products.filter', ['subCategoryId' => $subCategoryId ?? 0,'order' => request('order') ?? 'asc']) }}">
					Tất cả
				</a>

				@foreach($Alldanhmucs as $danhmuc)
					<a href="{{ route('products.filter', ['subCategoryId' => $danhmuc->category_id, 'order' => request('order') ?? 'asc']) }}"
						class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ request()->is('products/filter/' . $danhmuc->category_id) ? 'how-active1' : '' }}">
						{{ $danhmuc->category_name }}
					</a>
				@endforeach
			</div>

			<div class="flex-w flex-c-m m-tb-10">
				<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
					<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
					<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
					Filter
				</div>
			</div>
			<!-- Filter -->
			<div class="dis-none panel-filter w-full p-t-10">
				<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
					<div class="filter-col1 p-r-15 p-b-27">
						<div class="mtext-102 cl2 p-b-15">
							Sort By
						</div>

						<ul>

							<li class="p-b-6">
								<a href="{{ route('products.filter', ['subCategoryId' => $subCategoryId ?? 0, 'order' => 'asc']) }}"
									class="{{ request('order') == 'asc' ? 'filter-link-active' : '' }} filter-link stext-106 trans-04">
									Giá: Từ thấp đến cao
								</a>
							</li>
							<li class="p-b-6">
								<a href="{{ route('products.filter', ['subCategoryId' => $subCategoryId ?? 0, 'order' => 'desc']) }}"
									class="{{ request('order') == 'desc' ? 'filter-link-active' : '' }} filter-link stext-106 trans-04">
									Giá: Từ cao đến thấp
								</a>
							</li>


						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="row isotope-grid">
        @foreach ($products as $product)
			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
                    @if($product->images->isNotEmpty())
                                <img src="{{ $product->images->first()->image_path }}" alt="IMG-PRODUCT">
                            @else
                                <img src="/images/default-product.jpg" alt="IMG-PRODUCT">
                            @endif
							@php
    // Kiểm tra token đã có trong session chưa, nếu chưa thì tạo mới và lưu vào session
    $token = session('product_token', Str::random(32));

    // Lưu token vào session nếu nó không tồn tại
    session(['product_token' => $token]);

    // Mã hóa ID sản phẩm (chỉ mã hóa ID sản phẩm)
    $encodedId = Crypt::encryptString($product->product_id);
@endphp
						<a href="{{ route('users/product-detail', ['product_id' => $encodedId]) }}?token={{ $token }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="{{ route('users/product-detail', ['product_id' => $encodedId]) }}?token={{ $token }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								{{$product->product_name}}
							</a>

							<span class="stext-105 cl3">
								{{$product->price}}
							</span>
						</div>

						<div class="block2-txt-child2 flex-r p-t-3">
							<!-- Add to Wishlist Button -->
							<a href="javascript:void(0)" data-product-id="{{ $product->product_id }}" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
								<img class="icon-heart1 dis-block trans-04" src="/images/icons/icon-heart-01.png" alt="Empty Heart"> <!-- Empty heart -->
								<img class="icon-heart2 dis-block trans-04 ab-t-l" src="/images/icons/icon-heart-02.png" alt="Filled Heart"> <!-- Filled heart -->
							</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach

		</div>
	</div>
</div>

@endsection