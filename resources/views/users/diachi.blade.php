<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Địa chỉ của Tôi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
        }
        .header {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .header h1 {
            flex-grow: 1;
            text-align: center;
            font-size: 18px;
        }
        .address-list {
            padding: 15px 0;
        }
        .address-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }
        .address-item:last-child {
            border-bottom: none;
        }
        .address-header {
            display: flex;
            align-items: center;
            font-weight: bold;
        }
        .separator {
            margin: 0 5px;
            color: #888;
        }
        .address-phone {
            color: #888;
        }
        .address-details {
            color: #555;
        }
        .default-tag {
            display: inline-block;
            padding: 3px 6px;
            margin-top: 8px;
            font-size: 12px;
            color: #e53935;
            border: 1px solid #e53935;
            border-radius: 3px;
        }
        .add-address-btn {
            display: flex;
            padding: 10px;
            color: #e53935;
            border-top: 1px solid #eee;
            font-size: 16px;
            cursor: pointer;
            margin-top: 100px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <button onclick="goBack()">&#x2190;</button>
        <h1>Địa chỉ của Tôi</h1>
    </div>

    <div class="address-list">
        @foreach ($address as $addresses)
        <div class="address-item">
            <div class="address-header">
                <div class="address-name">Trịnh Viết Ký</div>
                <span class="separator">|</span>
                <div class="address-phone">(+84) 976 830 114</div>
            </div>
            <div class="address-details">
                26/18 Nguyễn Viết Xuân, Khu Phố Bình Đường 3<br>
                Phường An Bình, Thành Phố Dĩ An, Bình Dương
            </div>
            <div class="default-tag">Mặc định</div>
        </div>
        @endforeach

        <div class="address-item">
            <div class="address-header">
                <div class="address-name">Hoàng Mến</div>
                <span class="separator">|</span>
                <div class="address-phone">(+84) 348 648 006</div>
            </div>
            <div class="address-details">
                99/2c, Gia Yên<br>
                Xã Gia Tân 3, Huyện Thống Nhất, Đồng Nai
            </div>
        </div>

        <div class="address-item">
            <div class="address-header">
                <div class="address-name">Chị Trâm</div>
                <span class="separator">|</span>
                <div class="address-phone">(+84) 949 203 905</div>
            </div>
            <div class="address-details">
                Cđ Công Nghệ Thủ Đức, Số 29, Chương Dương (Cổng sau)<br>
                Phường Linh Chiểu, Thành Phố Thủ Đức, TP. Hồ Chí Minh
            </div>
        </div>
    </div>

        <div class="add-address-btn">
            <a href="{{route('users/address')}}" style="text-decoration: none; color: #e53935;">+ Thêm địa chỉ mới</a>
        </div>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>