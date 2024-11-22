@extends('users/app')

@section('title', 'Order History')

@section('menu-footer')
    <div class="container my-4">
        <h1 class="text-center">Your Order History</h1>

        <!-- Thanh điều hướng để lọc đơn hàng theo trạng thái -->
        <ul class="nav nav-tabs justify-content-center mb-4">
            <li class="nav-item">
                <a class="nav-link {{ $status == 'all' ? 'active' : '' }}" href="{{ route('order.history', ['status' => 'all']) }}">Tất cả</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $status == 'pending' ? 'active' : '' }}" href="{{ route('order.history', ['status' => 'pending']) }}">Chờ xác nhận</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $status == 'processing' ? 'active' : '' }}" href="{{ route('order.history', ['status' => 'processing']) }}">Chờ lấy hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $status == 'shipping' ? 'active' : '' }}" href="{{ route('order.history', ['status' => 'shipping']) }}">Chờ giao hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $status == 'completed' ? 'active' : '' }}" href="{{ route('order.history', ['status' => 'completed']) }}">Đã giao</a>
            </li>
        </ul>

        @if ($orders->count() > 0)
            @foreach ($orders as $order)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="https://via.placeholder.com/150" class="img-fluid" alt="Product Image">
                            </div>
                            <div class="col-md-9">
                                <h5 class="card-title">{{ $order->order_number }}</h5>
                                <p class="card-text">Trạng thái đơn hàng: {{ ucfirst($order->status) }}</p>
                                <p class="card-text">Giá: ${{ $order->total }}</p>
                                <p class="card-text">Thời gian: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary">Xem chi tiết</a>
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
