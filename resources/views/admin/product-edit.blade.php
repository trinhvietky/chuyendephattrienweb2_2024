@extends('admin/app')
@section('menu-footer')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="icon nalika-home"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Product Administrator</h2>
                                    <p>Welcome to T-Fashion <span class="bread-ntd">Shop</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-report">
                                <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="icon nalika-download"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Single pro tab start-->
<div class="single-product-tab-area mg-b-30">
    <!-- Single pro tab review Start-->
    <div class="single-pro-review-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="review-tab-pro-inner">
                        <ul id="myTab3" class="tab-review-design">
                            <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i> Add Product</a></li>

                        </ul>
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                                <div class="row">
                                    <form action="{{ route('productAdmin.update', [$product->product_id]) }}" method="post" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                    <input type="text" name="product_name" class="form-control" placeholder="Product Name" id="product_name" value="{{ $product->product_name }}" required>
                                                    @error('product_name')
                                                    <div class="error" style="color: red; background-color: #152036; padding-left: 7px;">{{ $message }}</div>
                                                    @enderror
                                                </div>


                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                    <input type="number" name="price" class="form-control" placeholder="Price" id="price" value="{{ $product->price }}" required step="1">
                                                </div>


                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                    <select name="category_id" class="form-control" id="sub_category_id" required>
                                                        <option value="" selected disabled>Category</option>
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->category_id }}" {{ $category->category_id == $product->category->category_id ? 'selected' : '' }}>
                                                            {{ $category->category_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                                    <textarea name="description" class="form-control" placeholder="Product Description" id="description" rows="4"> {{ $product->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                </div>

                            </div>
                        </div>


                        <div class="text-center custom-pro-edt-ds">
                            <button type="submit" class="btn btn-ctl-bt waves-effect waves-light m-r-10">Cập nhật</button>
                        </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>


    </div>
</div>
</div>
</div>
</div>
@endsection