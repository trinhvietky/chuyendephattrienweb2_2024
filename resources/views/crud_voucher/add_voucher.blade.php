@extends('header')
@section('text')

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
                        {{-- <ul id="myTab3" class="tab-review-design">
                            <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i> Add User</a></li>

                        </ul> --}}
                      
                        <div class="container mt-5" style="color: white">
                            <h2>Thêm Voucher</h2>
                            <form action="{{ route('create_voucher') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="voucherCode">Voucher code</label>
                                        <input value="{{ old('voucher_code') }}" type="text" class="form-control @error('voucher_code') is-invalid @enderror" id="voucherCode" placeholder="Nhập mã giảm giá..." name="voucher_code" required>
                                        @error('voucher_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="giaTriGiam">Giá trị giảm</label>
                                        <input value="{{ old('discount_amount') }}" type="number" class="form-control @error('discount_amount') is-invalid @enderror" id="giaTriGiam" placeholder="Nhập giá trị giảm..." name="discount_amount" required>
                                        @error('discount_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="ngayBatDau">Ngày bắt đầu</label>
                                        <input value="{{ old('start_date') }}" type="date" class="form-control @error('start_date') is-invalid @enderror" id="ngayBatDau" name="start_date" required>
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="ngayKetThuc">Ngày kết thúc</label>
                                        <input value="{{ old('end_date') }}" type="date" class="form-control @error('end_date') is-invalid @enderror" id="ngayKetThuc" name="end_date" required>
                                        @error('end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="soLanSuDung">Số lần sử dụng</label>
                                        <input value="{{ old('usage_limit') }}" type="number" class="form-control @error('usage_limit') is-invalid @enderror" id="soLanSuDung" placeholder="Nhập số lần sử dụng..." name="usage_limit" required>
                                        @error('usage_limit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="giaToiThieu">Giá tối thiểu áp dụng</label>
                                        <input value="{{ old('minimum_order') }}" type="number" class="form-control @error('minimum_order') is-invalid @enderror" id="giaToiThieu" placeholder="Nhập giá tối thiểu..." name="minimum_order" required>
                                        @error('minimum_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="form-group">
                                    <label for="moTa">Mô tả</label>
                                    <textarea value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror" id="moTa" rows="3" placeholder="Nhập mô tả..." name="description" required></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                    
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection