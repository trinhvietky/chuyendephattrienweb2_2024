@extends('admin/app')
@section('menu-footer')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="breadcome-area" style="margin-top: 40px;">
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
                                    <h2>Product list</h2>
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
                                    <form action="{{ route('product_variants.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                    <select name="color_id" id="color_id" class="form-control" required>
                                                        @foreach ($colors as $color)
                                                        <option value="{{ $color->color_id }}">{{ $color->color_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                                    <div class="custom-file form-control">
                                                        <input type="file" name="product_images[]" id="image1" class="custom-file-input">

                                                    </div>
                                                </div>
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                    <div class="custom-file form-control">
                                                        <input type="file" name="product_images[]" id="image2" class="custom-file-input">

                                                    </div>
                                                </div>
                                                <div class="input-group mg-b-pro-edt">
                                                    <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                    <div class="custom-file form-control">
                                                        <input type="file" name="product_images[]" id="image3" class="custom-file-input">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">

                                                            <div id="size-stock-container">
                                                                <div class="form-row mb-2">
                                                                    <div class="col-md-5">
                                                                        <div class="input-group mg-b-pro-edt">
                                                                            <span class="input-group-addon"><i class="icon nalika-unlocked" aria-hidden="true"></i></span>
                                                                            <select name="size_id[]" class="form-control" required>
                                                                                <option value="" selected disabled>Chọn kích thước</option>
                                                                                @foreach ($sizes as $size)
                                                                                <option value="{{ $size->size_id }}">{{ $size->size_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-5">
                                                                        <div class="input-group mg-b-pro-edt">
                                                                            <span class="input-group-addon"><i class="icon nalika-unlocked" aria-hidden="true"></i></span>
                                                                            <input type="number" name="stock[]" class="form-control" placeholder="Số lượng" required min="0">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <button type="button" class="btn btn-danger remove-size-row">X</button>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" id="add-size" class="btn" style="background-color: #007bff!important;">Thêm size</button>
                                            </div>
                                        </div>
                                        <div class="text-center custom-pro-edt-ds mt2">
                                            <button type="submit" class="btn btn-ctl-bt waves-effect waves-light m-r-10">Save</button>
                                            <button type="reset" class="btn btn-ctl-bt waves-effect waves-light">Discard</button>
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