@extends('users/app')

@section('menu-footer')

@if($products->isEmpty())
    <p>No products found.</p>
@else
    <div class="bg0 m-t-23 p-b-140" style="margin-top: 100px;">
        <div class="container">
            <div class="row isotope-grid">
                @foreach ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            @if($product->image->isNotEmpty())
                                <img src="{{ $product->image->first()->image_path }}" alt="IMG-PRODUCT">
                            @else
                                <img src="/images/default-product.jpg" alt="IMG-PRODUCT">
                            @endif

                            <a href="{{ route('users/product-detail', ['product_id' => $product->product_id]) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l">
                                <a href="{{ route('users/product-detail', ['product_id' => $product->product_id]) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{ $product->product_name }}
                                </a>

                                <span class="stext-105 cl3">
                                    ${{ $product->price }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

@endsection