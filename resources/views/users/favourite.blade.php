<!DOCTYPE html>
<html lang="en">

<head>
	<title>Favourite</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=" {{asset('/vendor/bootstrap/css/bootstrap.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/fonts/iconic/css/material-design-iconic-font.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/fonts/linearicons-v1.0.0/icon-font.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/vendor/animate/animate.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/vendor/css-hamburgers/hamburgers.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/vendor/animsition/css/animsition.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/vendor/select2/select2.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/vendor/daterangepicker/daterangepicker.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/vendor/slick/slick.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/vendor/MagnificPopup/magnific-popup.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/css-home/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css-home/main.css')}}">
	<link rel="stylesheet" href="{{asset('/css/app.css')}}">
	<!--===============================================================================================-->
</head>

<body class="animsition">

	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						Free shipping for standard order over $100
					</div>

					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m trans-04 p-lr-25">
							Help & FAQs
						</a>

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							My Account
						</a>

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							EN
						</a>

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							USD
						</a>
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->
					<a href="#" class="logo">
						<img src="/images/icons/logo-01.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="{{route('users/home')}}">Home</a>
							</li>

							<li>
								<a href="{{route('product')}}">Shop</a>
								<ul class="sub-menu">
									@if(isset($Alldanhmucs) && $Alldanhmucs->isNotEmpty())
									@foreach($Alldanhmucs as $danhmuc)
									<li><a href="index.html">{{$danhmuc->danhmuc_Ten}}</a></li>
									@endforeach
									@endif
								</ul>
							</li>

							<li>
								<a href="{{route('users/blog')}}">Blog</a>
							</li>

							<li>
								<a href="{{route('users/about')}}">About</a>
							</li>

							<li>
								<a href="{{route('users/contact')}}">Contact</a>
							</li>
						</ul>
					</div>

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="wrap-icon-header flex-w flex-r-m">
							<!-- Check if the user is authenticated -->
							@if (Route::has('login'))
							<div class="fixed top-0 right-0 px-6 py-4 sm:block">
								@auth
								<!-- User is authenticated: Show the dropdown menu -->
								<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
									<i class="zmdi zmdi-search"></i>
								</div>

								<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="2">
									<i class="zmdi zmdi-shopping-cart"></i>
								</div>

								<a href="{{route('users/favourite')}}" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-wishlist" data-notify="0">
									<i class="zmdi zmdi-favorite-outline"></i>
								</a>
								<style>
									.btn-link {
										margin-left: 30px;
										color: black;
									}

									.btn-link:hover {
										color: blue;
										text-decoration: none;
									}
								</style>
								@if(Auth::user()->usertype === '1')
								<a href="{{route('admin/dashboard')}}" class="btn-link">
									Dashboard
								</a>
								@endif
								<nav x-data="{ open: false }">
									<div class="flex justify-between h-16">
										<!-- Settings Dropdown -->
										<div class="hidden sm:flex sm:items-center sm:ml-6">
											<x-dropdown align="right" width="48">
												<x-slot name="trigger">
													<!-- <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150" >  -->
													<!-- <div>{{ Auth::user()->name }}</div> -->
													@if(Auth::user()->usertype === '0')
													<img src="{{ asset(Auth::user()->image) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%;
													cursor: pointer;" />
													@endif

													<!-- <div class="ml-1">
														<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
															<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
														</svg>
													</div> -->
													<!-- </button> -->
												</x-slot>
												<x-slot name="content">
													<x-dropdown-link :href="route('profile.edit')">
														{{ __('Profile') }}
													</x-dropdown-link>
													<form method="POST" action="{{ route('logout') }}">
														@csrf
														<x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
															{{ __('Log Out') }}
														</x-dropdown-link>
													</form>
												</x-slot>
											</x-dropdown>
										</div>
										<!-- Hamburger for mobile -->
										<div class="-mr-2 flex items-center sm:hidden">
											<button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
												<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
													<path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
													<path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
												</svg>
											</button>
										</div>
									</div>
									<!-- Responsive Navigation Menu -->
									<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
										<div class="pt-2 pb-3 space-y-1">
											<x-responsive-nav-link :href="route('users/home')" :active="request()->routeIs('users/home')">
												{{ __('Dashboard') }}
											</x-responsive-nav-link>
										</div>
										<!-- Responsive Settings Options -->
										<div class="pt-4 pb-1 border-t border-gray-200">
											<div class="px-4">
												<div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
												<div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
											</div>
											<div class="mt-3 space-y-1">
												<x-responsive-nav-link :href="route('profile.edit')">
													{{ __('Profile') }}
												</x-responsive-nav-link>
												<form method="POST" action="{{ route('logout') }}">
													@csrf
													<x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
														{{ __('Log Out') }}
													</x-responsive-nav-link>
												</form>
											</div>
										</div>
									</div>
								</nav>
								@else
								<!-- User is not authenticated: Show login and register links -->
								<a href="{{ route('login') }}" class="text-sm text-primary" style="font-size: 17px;">Log in</a>
								<a href="{{ route('auth.register') }}" class="ml-4 text-sm text-primary" style="font-size: 17px;">Register</a>
								@endauth
							</div>
							@endif
						</div>
					</div>
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->
			<div class="logo-mobile">
				<a href="index.html"><img src="/images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						Free shipping for standard order over $100
					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m p-lr-10 trans-04">
							Help & FAQs
						</a>

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							My Account
						</a>

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							EN
						</a>

						<a href="#" class="flex-c-m p-lr-10 trans-04">
							USD
						</a>
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li>
					<a href="{{route('users/home')}}">Home</a> 
				</li>

				<li>
					<a href="{{route('product')}}">Shop</a>
					<ul class="sub-menu">
						@if(isset($Alldanhmucs) && $Alldanhmucs->isNotEmpty())
						@foreach($Alldanhmucs as $danhmuc)
						<li><a href="index.html">{{$danhmuc->danhmuc_Ten}}</a></li>
						@endforeach
						@endif
					</ul>
				</li>

				<li>
					<a href="{{route('users/blog')}}">Blog</a>
				</li>

				<li>
					<a href="{{route('users/about')}}">About</a>
				</li>

				<li>
					<a href="{{route('users/contact')}}">Contact</a>
				</li>
			</ul>
		</div>

		<style>
			.suggestion-box {
				position: absolute;
				background: #fff;
				border: 1px solid #ddd;
				border-radius: 4px;
				max-height: 300px;
				/* Tăng chiều cao tối đa */
				overflow-y: auto;
				width: 100%;
				z-index: 1000;
				margin-top: 5px;
				padding: 10px;
				/* Tăng khoảng cách bên trong */
				box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			}

			.suggestion-item {
				display: flex;
				align-items: flex-start;
				/* Căn theo góc trái trên */
				margin-bottom: 15px;
				/* Tăng khoảng cách giữa các mục */
			}

			.suggestion-item img {
				width: 80px;
				/* Chiều rộng hình ảnh */
				height: 80px;
				/* Chiều cao hình ảnh */
				object-fit: cover;
				border-radius: 8px;
				/* Bo góc hình ảnh */
				margin-right: 15px;
				/* Khoảng cách giữa hình ảnh và nội dung */
				border: 1px solid #ddd;
				/* Viền xung quanh hình ảnh */
			}

			.suggestion-item:hover {
				background: #f8f9fa;
				/* Hiệu ứng hover */
			}

			.suggestion-item p {
				margin: 5px 0;
				font-size: 14px;
				/* Tăng kích thước chữ */
				color: #555;
			}

			.suggestion-item strong {
				font-size: 16px;
				/* Kích thước chữ tiêu đề lớn hơn */
				color: #333;
			}
		</style>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="/images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15" action="{{ route('products.search') }}" method="GET">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input
						class="plh3 search-input"
						type="text"
						name="search"
						placeholder="Search..."
						value="{{ request()->get('search') }}"
						autocomplete="off">
				</form>
				<div class="suggestion-box" style="display: none;"></div>
			</div>
		</div>
	</header>

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

	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Categories
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Women
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Men
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Shoes
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Watches
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Help
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Track Order
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Returns
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Shipping
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								FAQs
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						GET IN TOUCH
					</h4>

					<p class="stext-107 cl7 size-201">
						Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
					</p>

					<div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-pinterest-p"></i>
						</a>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Newsletter
					</h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Subscribe
							</button>
						</div>
					</form>
				</div>
			</div>

			<div class="p-t-40">
				<div class="flex-c-m flex-w p-b-18">
					<a href="#" class="m-all-1">
						<img src="/images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="/images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="/images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="/images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="/images/icons/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div>

				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> &amp; distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</p>
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="/images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
									<div class="item-slick3" data-thumb="/images/product-detail-01.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="/images/product-detail-01.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-02.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="/images/product-detail-02.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="/images/product-detail-02.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="/images/product-detail-03.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="/images/product-detail-03.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="/images/product-detail-03.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								Lightweight Jacket
							</h4>

							<span class="mtext-106 cl2">
								$58.79
							</span>

							<p class="stext-102 cl3 p-t-23">
								Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
							</p>

							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Size S</option>
												<option>Size M</option>
												<option>Size L</option>
												<option>Size XL</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Red</option>
												<option>Blue</option>
												<option>White</option>
												<option>Grey</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

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
			</div>
		</div>
	</div>
	<!-- search có gợi ý -->
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const searchInput = document.querySelector('.search-input');
			const suggestionBox = document.querySelector('.suggestion-box');

			searchInput.addEventListener('input', function() {
				const query = this.value.trim();
				if (query.length > 2) {
					fetch(`/products/suggestions?query=${query}`)
						.then(response => response.json())
						.then(data => {
							suggestionBox.innerHTML = '';
							suggestionBox.style.display = 'block';

							if (data.length > 0) {
								data.forEach(product => {
									const suggestionItem = document.createElement('div');
									suggestionItem.classList.add('suggestion-item');

									// Kiểm tra và lấy hình ảnh đầu tiên của sản phẩm, nếu không có thì sử dụng hình ảnh mặc định  
									const imagePath = product.image_path ? product.image_path : '/images/default-product.jpg'; // Hình ảnh mặc định nếu không có

									// Tạo nội dung cho gợi ý sản phẩm
									suggestionItem.innerHTML = `
	<a href="/product-detail/${product.product_id}" style="text-decoration: none;">
		<div class="flex">
			<img src="${imagePath}" alt="${product.product_name}" 
				 style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
			<div>
				<strong>${product.product_name}</strong>
				<p>Price: $${product.price}</p>
				<p>${product.description.substring(0, 50)}...</p>
			</div>
		</div>
	</a>
`;
									suggestionBox.appendChild(suggestionItem);

									// Click vào gợi ý để chọn
									suggestionItem.addEventListener('click', () => {
										searchInput.value = product.product_name;
										suggestionBox.innerHTML = '';
										suggestionBox.style.display = 'none';
									});
								});
							} else {
								suggestionBox.innerHTML = '<p>No suggestions found.</p>';
							}
						})
						.catch(error => console.error('Error fetching suggestions:', error));
				} else {
					suggestionBox.style.display = 'none';
				}
			});

			// Ẩn gợi ý khi click bên ngoài
			document.addEventListener('click', function(e) {
				if (!searchInput.contains(e.target) && !suggestionBox.contains(e.target)) {
					suggestionBox.style.display = 'none';
				}
			});
		});
	</script>
	<!--===============================================================================================-->
	<script src="{{asset('/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('/vendor/animsition/js/animsition.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function() {
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
	<!--===============================================================================================-->
	<script src="{{asset('/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('/vendor/daterangepicker/daterangepicker.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('/vendor/slick/slick.min.js')}}"></script>
	<script src="{{asset('/js-home/slick-custom.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('/vendor/parallax100/parallax100.js')}}"></script>
	<script>
		$('.parallax100').parallax100();
	</script>
	<!--===============================================================================================-->
	<script src="{{asset('/vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
				delegate: 'a', // the selector for gallery item
				type: 'image',
				gallery: {
					enabled: true
				},
				mainClass: 'mfp-fade'
			});
		});
	</script>
	<!--===============================================================================================-->
	<script src="{{asset('/vendor/isotope/isotope.pkgd.min.js')}}"></script>
	<!--===============================================================================================-->
	<script src="{{asset('/vendor/sweetalert/sweetalert.min.js')}}"></script>
	<script>
		$(document).ready(function() {
			// Fetch danh sách yêu thích của người dùng khi trang được tải
			fetchWishlist();

			// Hàm để lấy danh sách yêu thích và cập nhật giao diện
			function fetchWishlist() {
				fetch('/get-wishlist') // Gửi yêu cầu GET tới server để lấy dữ liệu danh sách yêu thích
					.then(response => response.json()) // Chuyển đổi phản hồi thành dạng JSON
					.then(data => {
						var wishlist = data.wishlist; // Danh sách các sản phẩm yêu thích

						// Thêm trạng thái 'added' cho các sản phẩm đã có trong danh sách yêu thích
						$('.js-addwish-b2').each(function() {
							var productId = $(this).data('product-id'); // Lấy ID của sản phẩm
							if (wishlist.includes(productId)) { // Kiểm tra xem sản phẩm có trong danh sách yêu thích không
								$(this).addClass('js-addedwish-b2'); // Thêm class để đánh dấu sản phẩm đã yêu thích
								$(this).off('click'); // Vô hiệu hóa sự kiện click để không thể thêm lại
							}
						});
					})
					.catch(error => console.error('Error fetching wishlist:', error)); // Xử lý lỗi nếu có
			}

			// Hàm để thêm sản phẩm vào danh sách yêu thích
			function addToWishlist(e) {
				e.preventDefault(); // Ngừng hành động mặc định của sự kiện (ví dụ: reload trang)
				var $button = $(this); // Lấy đối tượng button đã được nhấn
				var productId = $button.data('product-id'); // Lấy ID sản phẩm
				var nameProduct = $button.closest('.block2').find('.js-name-b2').text(); // Lấy tên sản phẩm

				// Gửi yêu cầu POST tới server để thêm sản phẩm vào danh sách yêu thích
				fetch('/add-to-wishlist', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': '{{ csrf_token() }}' // Thêm token CSRF để bảo vệ
						},
						body: JSON.stringify({
							product_id: productId
						}) // Gửi ID sản phẩm trong body của yêu cầu
					})
					.then(response => response.json()) // Chuyển phản hồi từ server thành JSON
					.then(data => {
						if (data.success) { // Nếu thêm sản phẩm thành công
							swal(nameProduct, "Thêm sản phẩm vào danh sách yêu thích thành công", "success"); // Hiển thị thông báo thành công

							// Thêm trạng thái 'added' cho nút và vô hiệu hóa nút
							$button.addClass('js-addedwish-b2');
							$button.off('click'); // Vô hiệu hóa sự kiện click để không thể thêm lại

							// Cập nhật số lượng thông báo yêu thích (wishlist)
							updateWishlistCount();
						}
					})
					.catch(error => {
						console.error('Error:', error);
						swal("Oops!", "Có lỗi khi thêm sản phẩm vào danh sách yêu thích.", "error"); // Thông báo lỗi
					});
			}

			// Hàm để xóa sản phẩm khỏi danh sách yêu thích
			function removeFromWishlist(e) {
				e.preventDefault(); // Ngừng hành động mặc định của sự kiện (ví dụ: reload trang)
				var $button = $(this); // Lấy đối tượng button đã được nhấn
				var productId = $button.data('product-id'); // Lấy ID sản phẩm
				var nameProduct = $button.closest('.block2').find('.js-name-b2').text(); // Lấy tên sản phẩm

				// Gửi yêu cầu POST tới server để xóa sản phẩm khỏi danh sách yêu thích
				fetch('/remove-from-wishlist', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': '{{ csrf_token() }}' // Thêm token CSRF để bảo vệ
						},
						body: JSON.stringify({
							product_id: productId
						}) // Gửi ID sản phẩm trong body của yêu cầu
					})
					.then(response => response.json()) // Chuyển phản hồi từ server thành JSON
					.then(data => {
						if (data.success) { // Nếu xóa sản phẩm thành công
							swal(nameProduct, "Xóa sản phẩm yêu thích thành công", "success"); // Hiển thị thông báo thành công

							// Xóa trạng thái 'added' cho nút và bật lại chức năng thêm sản phẩm vào wishlist
							$button.removeClass('js-addedwish-b2');
							$button.on('click', addToWishlist); // Kích hoạt lại sự kiện click để có thể thêm lại sản phẩm

							// Cập nhật số lượng thông báo yêu thích
							var currentNotify = parseInt($('.js-show-wishlist').attr('data-notify')) || 0; // Lấy số lượng yêu thích hiện tại
							if (currentNotify > 0) {
								$('.js-show-wishlist').attr('data-notify', currentNotify - 1); // Giảm số lượng thông báo yêu thích
							}
						}
					})
					.catch(error => {
						console.error('Error:', error);
						swal("Oops!", "Có lỗi khi xóa sản phẩm khỏi danh sách yêu thích.", "error"); // Thông báo lỗi
					});
			}

			// Gắn sự kiện click cho cả hai hành động: thêm và xóa sản phẩm trong danh sách yêu thích
			$(document).on('click', '.js-addwish-b2', addToWishlist); // Khi nhấn nút 'Thêm yêu thích'
			$(document).on('click', '.js-addedwish-b2', removeFromWishlist); // Khi nhấn nút 'Xóa yêu thích'

			// Cập nhật số lượng yêu thích (lấy từ API)
			function updateWishlistCount() {
				fetch('/get-wishlist')
					.then(response => response.json())
					.then(data => {
						var wishlistCount = data.wishlist.length;
						$('.js-show-wishlist').attr('data-notify', wishlistCount);
					});
			}
		});
		// Khi trang được tải lại, lấy số lượng yêu thích từ server
		$(document).ready(function() {
			fetch('/get-wishlist-count') // API lấy số lượng wishlist của người dùng
				.then(response => response.json())
				.then(data => {
					if (data.success) {
						// Cập nhật số lượng yêu thích trong giao diện
						$('.js-show-wishlist').attr('data-notify', data.wishlistCount);
					}
				})
				.catch(error => console.error('Error fetching wishlist count:', error));
		});

		$(document).on('click', '.js-addedwish-b2', function(e) {
			e.preventDefault(); // Ngừng hành động mặc định
			var $button = $(this);
			var productId = $button.data('product-id');

			// Gửi yêu cầu POST để xóa sản phẩm khỏi danh sách yêu thích
			fetch('/remove-from-wishlist', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF Token
					},
					body: JSON.stringify({
						product_id: productId
					})
				})
				.then(response => response.json())
				.then(data => {
					if (data.success) {
						swal("Xóa khỏi yêu thích thành công!", "", "success");

						// Xóa sản phẩm khỏi danh sách yêu thích ngay lập tức trên trang
						$button.closest('.isotope-item').remove(); // Xóa sản phẩm khỏi DOM

						// Cập nhật số lượng yêu thích trong thông báo
						updateWishlistCount();
					}
				})
				.catch(error => console.error('Error:', error));
		});
	</script>
	<!--===============================================================================================-->
	<script src="{{asset('/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
	<script>
		$('.js-pscroll').each(function() {
			$(this).css('position', 'relative');
			$(this).css('overflow', 'hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function() {
				ps.update();
			})
		});
	</script>
	<!--===============================================================================================-->
	<script src="/js-home/main.js"></script>
	<script src="{{asset(path: '/js/app.js')}}"></script>
</body>

</html>