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
                                    <h2>Voucher Administrator</h2>
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
                        {{-- <ul id="myTab3" class="tab-review-design">
                            <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i> Edit User</a></li>

                        </ul> --}}
                        <div class="container mt-5" style="color: white">
                            <h2>Thông tin Voucher</h2>
                            <form action="{{ route('update_voucher', $voucher->id) }}" method="POST">
                                @csrf
                    
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="voucherCode">Voucher code</label>
                                        <input value="{{ $voucher->voucher_code }}" type="text" class="form-control" id="voucherCode"
                                            placeholder=" input here..." name="voucher_code" required>
                    
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="giaTriGiam">Giá trị giảm</label>
                                        <input value="{{ $voucher->discount_amount }}" type="text" class="form-control" id="giaTriGiam"
                                            placeholder=" input here..." name="discount_amount" required>
                    
                                    </div>
                                </div>
                    
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="ngayBatDau">Ngày bắt đầu</label>
                                        <input value={{ $voucher->start_date }} type="date" class="form-control" id="ngayBatDau"
                                            name="start_date" required>
                    
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="ngayKetThuc">Ngày kết thúc</label>
                                        <input value={{ $voucher->end_date }} type="date" class="form-control" id="ngayKetThuc"
                                            name="end_date" required>
                    
                                    </div>
                                </div>
                    
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="soLanSuDung">Số lần sử dụng</label>
                                        <input value="{{ $voucher->usage_limit }}" type="text" class="form-control" id="soLanSuDung"
                                            placeholder=" input here..." name="usage_limit" required>
                    
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="giaToiThieu">Giá tối thiểu áp dụng</label>
                                        <input value="{{ $voucher->minimum_order }}" type="text" class="form-control" id="giaToiThieu"
                                            placeholder=" input here..." name="minimum_order">
                    
                                    </div>
                                </div>
                    
                                <div class="form-group">
                                    <label for="moTa">Mô tả</label>
                                    <textarea class="form-control" id="moTa" rows="3" placeholder=" input here..." name="description" required>{{ $voucher->description }}</textarea>
                    
                                </div>
                    
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection