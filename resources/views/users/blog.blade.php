@extends('users/app')
@section('title', 'Blog')
@section('menu-footer')

<!-- Title page -->
<div class="header" style="margin-top: 100px;">
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('/images/bg-02.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Blog
		</h2>
	</section>
</div>


<!-- Content page -->
<section class="bg0 p-t-62 p-b-60">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-9 p-b-80">
				<div class="p-r-45 p-r-0-lg">
					@foreach ($blogs as $blog)
					<div class="blog" style="display: flex;">
						<div class="p-b-63">
							<a href="{{ route('blogs.show', $blog->blog_id) }}" class="hov-img0 how-pos5-parent">
								<img src="{{ asset($blog->cover_image) }}" alt="IMG-BLOG" style="max-width: 100%; max-height: 100%; height: auto; width: auto;">

								<div class="flex-col-c-m size-123 bg9 how-pos5">
									<span class="ltext-107 cl2 txt-center">
										{{ $blog->created_at->format('d') }}
									</span>

									<span class="stext-109 cl3 txt-center">
										{{ $blog->created_at->format('M') }} {{ $blog->created_at->format('y') }}
									</span>
								</div>
							</a>

							<div class="p-t-32">
								<h4 class="p-b-15">
									<a href="{{ route('blogs.show', $blog->blog_id) }}" class="ltext-108 cl2 hov-cl1 trans-04">
										{{ $blog->title }}
									</a>
								</h4>

								<p class="stext-117 cl6">
								{{ Str::limit($blog->content, 50, '......') }}
								</p>

								<div class="flex-w flex-sb-m p-t-18">

									<a href="{{ route('blogs.show', $blog->blog_id) }}" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
										Continue Reading

										<i class="fa fa-long-arrow-right m-l-9"></i>
									</a>
								</div>
							</div>
						</div>
					</div>

					@endforeach

					<!-- Pagination -->
					<div class="pagination">
						{{ $blogs->links('pagination::bootstrap-4') }}
					</div>
				</div>
			</div>

			<div class="col-md-4 col-lg-3 p-b-80">
				<div class="side-menu">

					<div>
						<h4 class="mtext-112 cl2 p-b-33">
							Categories
						</h4>

						<ul>
							@foreach($categories as $category)
							<li class="bor18">
								<a href="#" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
									{{ $category->category_name }}
								</a>
							</li>
							@endforeach
						</ul>
					</div>

					<div class="p-t-65">
						<h4 class="mtext-112 cl2 p-b-33">
							Featured Products
						</h4>

						<ul>
							@foreach($latestProducts as $product)
							<li class="flex-w flex-t p-b-30">


							@php
						// Kiểm tra token đã có trong session chưa, nếu chưa thì tạo mới và lưu vào session
						$token = session('product_token', Str::random(32));

						// Lưu token vào session nếu nó không tồn tại
						session(['product_token' => $token]);

						// Mã hóa ID sản phẩm (chỉ mã hóa ID sản phẩm)
						$encodedId = Crypt::encryptString($product->product_id);
						@endphp


								<a href="{{ route('users/product-detail', ['product_id' => $encodedId]) }}?token={{ $token }}" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
									<img src="{{ asset($product->images->first()->image_path) }}" alt="PRODUCT">
								</a>

								<div class="size-215 flex-col-t p-t-8">
									<a href="{{ route('users/product-detail', ['product_id' => $encodedId]) }}?token={{ $token }}" class="stext-116 cl8 hov-cl1 trans-04">
										{{$product->product_name}}
									</a>

									<span class="stext-116 cl6 p-t-20">
										{{ number_format($product->price, 0, ',', '.') }}đ
									</span>
								</div>
							</li>
							@endforeach
						</ul>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
@endsection