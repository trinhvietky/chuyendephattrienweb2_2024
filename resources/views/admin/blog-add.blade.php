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
                                    <h2>Blog Administrator</h2>
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
                            <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i> Add Blog</a></li>

                        </ul>
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                                <div class="row">
                                    <form action="{{ route('blogs.store') }}" method="POST" novalidate enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                            <input type="text" name="title" class="form-control" placeholder="Blog title" style="padding-left: 12px;" value="{{ old('title') }}" required>
                                            @error('title')
                                            <div class="text-danger error" style="color: red; background-color: #152036; padding-left: 7px;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                            <textarea name="content" class="form-control" placeholder="Blog content" id="content" rows="5" required>{{ old('content') }}</textarea>
                                            @error('content')
                                            <div class="text-danger error" style="color: red; background-color: #152036; padding-left: 7px;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="fa fa-image" style="margin-right: 25px; color: gray" aria-hidden="true"></i>Ảnh bìa</span>
                                            <div class="custom-file form-control">
                                                <input type="file" name="cover_image" id="cover_image" class="custom-file-input">
                                                @error('cover_image')
                                                <div class="text-danger error" style="color: red; background-color: #152036; padding-left: 47px; margin-left: -124px;">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="text-center custom-pro-edt-ds">
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
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy tất cả các trường input trong form
            const inputs = document.querySelectorAll('input, textarea, select');

            // Lặp qua các trường input và thêm sự kiện 'input' để ẩn thông báo lỗi
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    // Tìm phần tử thông báo lỗi tương ứng (nếu có)
                    const errorElement = this.nextElementSibling;
                    if (errorElement && errorElement.classList.contains('error')) {
                        errorElement.style.display = 'none'; // Ẩn thông báo lỗi
                    }
                });
            });
        });
    </script>
    @endsection
