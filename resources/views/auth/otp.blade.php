<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href=" {{asset('/vendor/bootstrap/css/bootstrap.min.css')}}">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Xác nhận mã OTP</h2>
                        <!-- Thông báo đếm ngược thời gian -->
                        <div class="alert alert-warning text-center">
                            Mã OTP sẽ hết hạn sau <span id="timer">02:00</span> phút.
                        </div>
                        <form method="POST" action="{{ route('password.checkOtp') }}">
                            @csrf
                            <!-- Địa chỉ email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" class="form-control" value="{{ session('password_reset_email') }}" readonly>
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- OTP -->
                            <div class="mb-3">
                                <label for="otp" class="form-label">OTP</label>
                                <input id="otp" type="text" name="otp" class="form-control" required>
                                @error('otp')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                        <!-- Nút gửi lại OTP -->
                        <div class="mt-3 text-center">
                            <button class="btn btn-secondary" id="resend-btn" disabled>Gửi lại mã OTP</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="{{asset('/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <script>
       // Khởi tạo biến thời gian đếm ngược
    let timeLeft = 120;
    let countdown;  // Đặt biến countdown ở ngoài để có thể điều khiển clearInterval

    // Tìm phần tử hiển thị bộ đếm thời gian và nút gửi lại OTP
    const timerElement = document.getElementById('timer');
    const resendButton = document.getElementById('resend-btn');

    // Hàm format thời gian (phút:giây)
    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
    }

    // Hàm đếm ngược thời gian
    function startCountdown() {
        // Xóa bất kỳ countdown cũ nào trước khi khởi động lại
        clearInterval(countdown);
        countdown = setInterval(function() {
            if (timeLeft > 0) {
                timeLeft--;
                timerElement.textContent = formatTime(timeLeft);
            } else {
                clearInterval(countdown);
                resendButton.disabled = false;
                resendButton.classList.remove('btn-secondary');
                resendButton.classList.add('btn-primary');
            }
        }, 1000);
    }

    // Khởi động đếm ngược ban đầu
    startCountdown();

    // Xử lý sự kiện khi người dùng nhấn nút "Gửi lại mã OTP"
    resendButton.addEventListener('click', function() {
        // Vô hiệu hóa nút sau khi bấm
        resendButton.disabled = true;
        resendButton.classList.remove('btn-primary');
        resendButton.classList.add('btn-secondary');

        fetch('{{route("auth.password.resendOtp")}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                alert(data.status);  // Hoặc hiển thị thông báo khác cho người dùng
                // Đặt lại thời gian đếm ngược
                timeLeft = 15; 
                timerElement.textContent = formatTime(timeLeft);
                startCountdown();  // Bắt đầu lại quá trình đếm ngược
            }
        })
        .catch(error => {
            console.error('Lỗi:', error);
            // Trong trường hợp có lỗi, cho phép bấm lại nút
            resendButton.disabled = false;
            resendButton.classList.remove('btn-secondary');
            resendButton.classList.add('btn-primary');
        });
    });

</script>


</body>

</html>