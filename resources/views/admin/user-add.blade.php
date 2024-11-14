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
                                    <h2>User Administrator</h2>
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
                            <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i> Add User</a></li>

                        </ul>
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                                <div class="row">
                                    <form action="{{ route('users.store') }}" method="POST" novalidate>
                                        @csrf
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                            <input type="text" name="name" class="form-control" placeholder="Full name" required style="background: #152036; font-size: 16px">
                                            @error('name')
                                            <div class="error" style="color: red; background-color: #152036; padding-left: 7px;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                            <input type="email" name="email" class="form-control" placeholder="Email" required style="background: #152036; font-size: 16px">
                                            @error('email')
                                            <div class="error" style="color: red; background-color: #152036; padding-left: 7px;">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                            <input type="text" name="phone" class="form-control" placeholder="Phone" required style="background: #152036; font-size: 16px">
                                            @error('phone')
                                            <div class="error" style="color: red; background-color: #152036; padding-left: 7px;">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                            <input type="text" name="role" class="form-control" placeholder="Quyền" required style="background: #152036; font-size: 16px">
                                            @error('role')
                                            <div class="error" style="color: red; background-color: #152036; padding-left: 7px;">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-unlocked" aria-hidden="true"></i></span>
                                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" style="background: #152036; font-size: 16px">
                                            @error('password')
                                            <div class="error" style="color: red; background-color: #152036; padding-left: 7px;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="text-center custom-pro-edt-ds">
                                            <button type="submit" style="background-color: #337ab7;" class="btn btn-ctl-bt waves-effect waves-light m-r-10">Save</button>
                                            <button type="reset" style="background-color: #337ab7;" class="btn btn-ctl-bt waves-effect waves-light">Discard</button>
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
    @endsection

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Lấy tất cả các trường input trong form
        const inputs = document.querySelectorAll('input, textarea, select');

        // Lặp qua các trường input và thêm sự kiện 'input' để ẩn thông báo lỗi
        inputs.forEach(input => {
            input.addEventListener('input', function () {
                // Tìm phần tử thông báo lỗi tương ứng (nếu có)
                const errorElement = this.nextElementSibling;
                if (errorElement && errorElement.classList.contains('error')) {
                    errorElement.style.display = 'none'; // Ẩn thông báo lỗi
                }
            });
        });
    });
</script>
