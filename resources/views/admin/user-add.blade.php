<<<<<<< HEAD
@extends('header')
@section('text')
=======
@extends('admin/app')
@section('menu-footer')
>>>>>>> maitrananhtuan_trangtru_user_dangnhap,trangtru_admin_dangnhap

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="breadcome-area">
<<<<<<< HEAD
    <div class="container-fluid">
=======
    <div class="container-fluid" style="margin-top: 70px;">
>>>>>>> maitrananhtuan_trangtru_user_dangnhap,trangtru_admin_dangnhap
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
                                    <form action="{{ route('users.store') }}" method="POST">
                                        @csrf
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
<<<<<<< HEAD
                                            <input type="text" name="name" class="form-control" placeholder="Full name" required>
                                        </div>
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                                        </div>
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                            <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                                        </div>
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                            <input type="text" name="role" class="form-control" placeholder="Quyền" required>
                                        </div>
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-unlocked" aria-hidden="true"></i></span>
                                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
=======
                                            <input type="text" name="name" class="form-control" placeholder="Full name" required style="background: #152036; font-size: 16px">
                                        </div>
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                            <input type="email" name="email" class="form-control" placeholder="Email" required style="background: #152036; font-size: 16px">
                                        </div>
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                            <input type="text" name="phone" class="form-control" placeholder="Phone" required style="background: #152036; font-size: 16px">
                                        </div>
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                            <input type="text" name="role" class="form-control" placeholder="Quyền" required style="background: #152036; font-size: 16px">
                                        </div>
                                        <div class="input-group mg-b-pro-edt">
                                            <span class="input-group-addon"><i class="icon nalika-unlocked" aria-hidden="true"></i></span>
                                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" style="background: #152036; font-size: 16px">
>>>>>>> maitrananhtuan_trangtru_user_dangnhap,trangtru_admin_dangnhap
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
    @endsection