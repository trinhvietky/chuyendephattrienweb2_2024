@extends('admin/app')
@section('menu-footer')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <style>
        .invalid-feedback {
            position: absolute;
            font-size: 12px;
            color: #dc3545;
        }

        input.is-invalid {
            border-color: #dc3545;
        }
    </style>
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
                                        <h2>Voucher list</h2>
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
                                            aria-hidden="true"></i>edit voucher</a></li>
                            </ul>
                            <div class="container mt-5" style="color: white">

                                <form action="{{ route('update_voucher', $voucher->id) }}" method="POST">
                                    @csrf

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="voucherCode">Voucher code</label>
                                            <input style="background: #152036; font-size: 14px"
                                                value="{{ $voucher->voucher_code }}" type="text"
                                                class="form-control @error('voucher_code') is-invalid @enderror"
                                                id="voucherCode" placeholder=" input here..." name="voucher_code" required>
                                            @error('voucher_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="giaTriGiam">Giá trị giảm</label>
                                            <input style="background: #152036; font-size: 14px"
                                                value="{{ $voucher->discount_amount }}" type="text"
                                                class="form-control @error('discount_amount') is-invalid @enderror"
                                                id="giaTriGiam" placeholder=" input here..." name="discount_amount"
                                                required>
                                            @error('discount_amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="ngayBatDau">Ngày bắt đầu</label>
                                            <input style="background: #152036; font-size: 14px"
                                                value={{ $voucher->start_date }} type="date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                id="ngayBatDau" name="start_date" required>
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="ngayKetThuc">Ngày kết thúc</label>
                                            <input style="background: #152036; font-size: 14px"
                                                value={{ $voucher->end_date }} type="date"
                                                class="form-control @error('end_date') is-invalid @enderror"
                                                id="ngayKetThuc" name="end_date" required>
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="soLanSuDung">Số lần sử dụng</label>
                                            <input style="background: #152036; font-size: 14px"
                                                value="{{ $voucher->usage_limit }}" type="text"
                                                class="form-control @error('usage_limit') is-invalid @enderror"
                                                id="soLanSuDung" placeholder=" input here..." name="usage_limit" required>
                                            @error('usage_limit')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="giaToiThieu">Giá tối thiểu áp dụng</label>
                                            <input style="background: #152036; font-size: 14px"
                                                value="{{ $voucher->minimum_order }}" type="text"
                                                class="form-control @error('minimum_order') is-invalid @enderror"
                                                id="giaToiThieu" placeholder=" input here..." name="minimum_order">
                                            @error('minimum_order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="moTa">Mô tả</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="moTa" rows="5"
                                            placeholder=" input here..." name="description" required>{{ $voucher->description }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
