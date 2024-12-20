@extends('admin/app')
@section('menu-footer')
    <div class="breadcome-area">
        <div class="container-fluid" style="margin-top: 70px;">
            {{-- thông báo --}}
            @if (session('success'))
                <div class="alert alert-success" style="margin: 10px 0px -10px 0px" id="success">
                    {{ session('success') }}
                </div>
                <script>
                    // Tự động ẩn thông báo sau 3 giây
                    setTimeout(function() {
                        document.getElementById('success').style.display = 'none';
                    }, 5000);
                </script>
            @endif

            {{-- thông báo lỗi --}}
            @if (session('error'))
                <div class="alert alert-danger" style="margin: 10px 0px -10px 0px" id="success">
                    {{ session('error') }}
                </div>
                <script>
                    // Tự động ẩn thông báo sau 3 giây
                    setTimeout(function() {
                        document.getElementById('success').style.display = 'none';
                    }, 5000);
                </script>
            @endif
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
    <div class="product-status mg-b-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Voucher List</h4>
                        <div class="add-product">
                            <a href="{{ route('Voucher-create') }}">Add Voucher</a>
                        </div>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Voucher Code</th>
                                <th>Mô tả</th>
                                <th>giảm giá</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>giá tối thiểu AD</th>
                                <th>Lần sử dụng</th>
                                <th>trạng thái đơn hàng</th>
                                <th>Công cụ</th>
                            </tr>
                            @foreach ($vouchers as $voucher)
                                <tr>
                                    <td>{{ $voucher->id }}</td>
                                    <td>{{ $voucher->voucher_code }}</td>
                                    <td>{{ Str::limit($voucher->description, 10, '...') }}</td>
                                    <td>{{ $voucher->discount_amount }} %</td>
                                    <td>{{ \Carbon\Carbon::parse($voucher->start_date)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}</td>
                                    <td>{{ Str::limit(number_format($voucher->minimum_order, 0, ',', '.'), 9, '...') }} VND
                                    </td>
                                    <td>{{ Str::limit(number_format($voucher->usage_limit, 0, ',', '.'), 9, '...') }} lần
                                    </td>
                                    <td>
                                        @if (($voucher->usage_limit > 0) & ($voucher->end_date >= \Carbon\Carbon::today()))
                                            <span class="badge badge-success" style="background-color: green;">Có sẵn</span>
                                        @else
                                            <span class="badge badge-danger" style="background-color: red;">Hết hạn</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            // Kiểm tra token đã có trong session chưa, nếu chưa thì tạo mới và lưu vào session
                                            $token = session('voucher_token', Str::random(32));

                                            // Lưu token vào session nếu nó không tồn tại
                                            session(['voucher_token' => $token]);

                                            // Mã hóa ID sản phẩm (chỉ mã hóa ID sản phẩm)
                                            $encodedId = Crypt::encryptString($voucher->id);
                                        @endphp
                                        <div class="d-flex align-items-center">
                                            <a
                                                href="{{ route('edit_voucher', ['id' => $encodedId]) }}?token={{ $token }}"><i
                                                    class='fa fa-pencil-square-o  mr-2'></i></a>
                                            <form action="{{ route('delete_voucher', $voucher->id) }}" method="POST"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa voucher này?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="" style="border:none; background:none;">
                                                    <i class='fa fa-trash-o' style="color: red"></i>
                                                </button>
                                            </form>

                                        </div>

                                    </td>

                                </tr>
                            @endforeach
                        </table>
                        {{-- {{ $vouchers->links('layouts.navigation') }} --}}
                        {{ $vouchers->links('pagination::bootstrap-4') }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
