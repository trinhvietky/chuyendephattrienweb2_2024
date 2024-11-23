@extends('users/app')
@section('title', 'Order History')
@section('menu-footer')

    <!-- Title page -->
    <div class="header" style="margin-top: 100px;">
        <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('/images/bg-01.jpg');">
            <h2 class="ltext-105 cl0 txt-center">
                Order History
            </h2>
        </section>
    </div>

    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116">
        <div class="container orderhis-body">
            {{-- <h1 class="text-center">Your Order History</h1> --}}

            <!-- Thanh điều hướng để lọc đơn hàng theo trạng thái -->
            <ul class="nav nav-tabs justify-content-center mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'all' ? 'active' : '' }}"
                        href="{{ route('order.history', ['status' => 'all']) }}">Tất cả</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'pending' ? 'active' : '' }}"
                        href="{{ route('order.history', ['status' => 'pending']) }}">Chờ xác nhận</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'processing' ? 'active' : '' }}"
                        href="{{ route('order.history', ['status' => 'processing']) }}">Chờ lấy hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'shipping' ? 'active' : '' }}"
                        href="{{ route('order.history', ['status' => 'shipping']) }}">Chờ giao hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'completed' ? 'active' : '' }}"
                        href="{{ route('order.history', ['status' => 'completed']) }}">Đã giao</a>
                </li>
            </ul>

            @if ($orders->count() > 0)
                @foreach ($orders as $order)
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="{{ $order->photo_path }}" class="img-fluid" alt="Product Image"
                                        width="100px">
                                </div>
                                <div class="col-md-9">
                                    <h5 class="card-title">{{ $order->product_name }}</h5>
                                    <h5 class="card-title">{{ $order->order_number }}</h5>
                                    @php
                                        $statusMap = [
                                            0 => 'Chưa hoàn thành',
                                            1 => 'Hoàn thành',
                                            2 => 'Đang xử lý', // Thêm trạng thái nếu cần
                                            3 => 'Đã giao hàng thành công',
                                            4 => 'Đã hủy',
                                        ];
                                    @endphp

                                    <p class="card-text">
                                        Trạng thái đơn hàng: {{ $statusMap[$order->status] ?? 'Không xác định' }}
                                    </p>
                                    <p class="card-text">Giá: {{ $order->total_amount }} VND</p>
                                    <p class="card-text">Thời gian: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                                    @php
                                        // Kiểm tra token đã có trong session chưa, nếu chưa thì tạo mới và lưu vào session
                                        $token = session('voucher_token', Str::random(32));

                                        // Lưu token vào session nếu nó không tồn tại
                                        session(['voucher_token' => $token]);

                                        // Mã hóa ID sản phẩm (chỉ mã hóa ID sản phẩm)
                                        $encodedId = Crypt::encryptString($order->id);
                                    @endphp
                                    {{-- <a href="{{ route('order.show', ['id' => $encodedId]) }}?token={{ $token }}" class="btn btn-primary">Xem chi tiết</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            @else
                <p class="text-center">You have no orders yet.</p>
            @endif
        </div>
    </section>

@endsection

<style>
    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .pagination {
        margin-top: 20px;
    }

    .pagination .page-item .page-link {
        color: #007bff;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }

    .pagination .page-item .page-link:hover {
        background-color: #0056b3;
        border-color: #004085;
        color: #fff;
    }
</style>
