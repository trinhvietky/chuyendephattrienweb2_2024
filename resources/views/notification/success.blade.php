<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán thành công</title>
    <!-- Liên kết đến Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href=" {{asset('/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center min-vh-100 mt-5">
        <div class="card p-4" style="width: 100%; max-width: 600px;">
            <div class="text-center mb-4">
                <img src="https://via.placeholder.com/150" alt="Logo" class="img-fluid mb-3">
                <h2 class="text-success">Thanh toán thành công!</h2>
            </div>
            <div class="mb-4">
                <p>Cảm ơn bạn đã thanh toán cho đơn hàng của chúng tôi.</p>
                <p>Mã đơn hàng của bạn là: <strong>#{{$order_id}}</strong></p>
                <p>Số tiền đã thanh toán: <strong>{{ number_format($amount / 100 , 0, ',', '.')}}</strong></p>
                <p>Thời gian thanh toán: <strong>{{$payment_time}}</strong></p>
            </div>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{route('users/home')}}" class="btn btn-primary mx-2">Quay lại trang chủ</a>
                <a href="{{route('product')}}" class="btn btn-success mx-2">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>

    <!-- Liên kết đến Bootstrap JS và Popper -->
    <script src="{{asset('/vendor/bootstrap/js/popper.js')}}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>