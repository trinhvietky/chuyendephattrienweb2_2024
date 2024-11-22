@extends('admin/app')
@section('menu-footer')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<div class="breadcome-area">
    <div class="container-fluid" style="margin-top: 70px;">
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
                                    <h2>Danh muc Administrator</h2>
                                    <p>Welcome to T-Fashion <span class="bread-ntd">Shop</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-report">
                                <button data-toggle="tooltip" data-placement="left" title="Download Report"
                                    class="btn"><i class="icon nalika-download"></i></button>
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
                            <li class="active"><a href="#description"><i class="icon nalika-edit"
                                        aria-hidden="true"></i> Edit Danh muc</a></li>

                        </ul>
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                                <div class="row">
                                    <form action="{{route('danhmuc.update', $danhmuc->category_id)}}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-user"
                                                    aria-hidden="true"></i></span>
                                            <input type="text" name="category_name" class="form-control"
                                                placeholder="Tên danh mục" value="{{ $danhmuc->category_name }}" required
                                                style="background: #152036;
                                            font-size: 17px;">
                                        @error('category_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        </div>


                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection