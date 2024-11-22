<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ProductVariant;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public static function createPayment($order, $paymetMethod)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        // Lưu dữ liệu vào payment với trạng thái giao dịch bằng 0
        Payment::create([
            'order_id' => $order->order_id,
            'amount' => $order->total_amount,
            'payment_method' => $paymetMethod,
            'payment_status' => 0
        ]);



        // Cấu hình thông tin thanh toán
        $vnp_TmnCode = config('vnpay.vnp_TmnCode'); // Mã website của bạn
        $vnp_HashSecret = config('vnpay.vnp_HashSecret'); // Chuỗi bí mật
        $vnp_Url = config('vnpay.vnp_Url'); // URL thanh toán của VNPAY
        $vnp_Returnurl = config('vnpay.vnp_Returnurl'); // URL trả kết quả
        $vnp_BankCode = "VNBANK";

        // Tạo mã giao dịch duy nhất
        $vnp_TxnRef = $order->order_id . '-' . time();

        // Thời gian hết hạn thanh toán
        // Lấy thời gian hiện tại
        $now = new DateTime();

        // Thêm 15 phút vào thời gian hiện tại
        $now->add(new DateInterval('PT15M'));

        // Định dạng theo định dạng YmdHis
        $expire = $now->format('YmdHis');

        // Dữ liệu thanh toán
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $order->total_amount * 100, // Đơn vị là VND x100
            "vnp_Command" => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => request()->ip(),
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => "Thanh toán đơn hàng #" . $order->order_id,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => route('payment.return'),
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire,
        ];


        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }

    // public function ipnUrl(Request $request)
    // {
    //     $vnp_HashSecret = config('vnpay.vnp_HashSecret');
    //     $inputData = $request->all();
    //     $vnp_SecureHash = $inputData['vnp_SecureHash'];
    //     unset($inputData['vnp_SecureHash']);
    //     ksort($inputData);
    //     $hashData = http_build_query($inputData);

    //     $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    //     if ($secureHash === $vnp_SecureHash) {
    //         if ($inputData['vnp_ResponseCode'] == '00') {
    //             // Xử lý cập nhật trạng thái giao dịch vào database
    //             $payment = Payment::where('order_id', $inputData['vnp_TxnRef'])
    //                 ->where('payment_status', 0) // Giả sử 0 là "chờ xử lý"
    //                 ->first();
    //             $payment->status = 1;
    //             $payment->save();

    //             return response()->json(['RspCode' => '00', 'Message' => 'Giao dịch thành công']);
    //         } else {
    //             return response()->json(['RspCode' => '01', 'Message' => 'Giao dịch thất bại']);
    //         }
    //     } else {
    //         return response()->json(['RspCode' => '97', 'Message' => 'Chữ ký không hợp lệ']);
    //     }
    // }

    public function returnUrl(Request $request)
    {
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = http_build_query($inputData);

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                // Xử lý cập nhật trạng thái giao dịch vào database
                $payment = Payment::where('order_id', $inputData['vnp_TxnRef'])
                    ->where('payment_status', 0) // Giả sử 0 là "chờ xử lý"
                    ->first();
                if ($payment) {
                    $payment->payment_status = 1;
                    $payment->save();
                }

                $carts = session('carts');
                session()->forget('carts');  // Xóa giỏ hàng khỏi session
                if ($carts) {
                    foreach ($carts as $cart) {
                        Cart::where('cart_id', $cart['cart_id'])->delete();
                        $productVariant = ProductVariant::where('productVariant_id', $cart['productVariant_id'])->first();
                        $productVariant->stock -= $cart['quantity'];
                        $productVariant->save();
                    }
                }

                $date = DateTime::createFromFormat('YmdHis', $inputData['vnp_PayDate']);
                $date->format('d-m-Y H:i:s');
                $dateString = $date->format('d-m-Y H:i:s');

                return view('notification/success', [
                    'message' => 'Giao dịch thành công',
                    'rspCode' => '00',
                    'order_id' => $inputData['vnp_TxnRef'],
                    'amount' => $inputData['vnp_Amount'],
                    'payment_time' => htmlspecialchars($dateString)
                ]);
            } else {
                Order::where('order_id', $inputData['vnp_TxnRef'])->delete();
                return view('notification/fail', [
                    'message' => 'Giao dịch thất bại',
                    'rspCode' => '01'
                ]);
            }
        } else {
            return response()->json(['RspCode' => '97', 'Message' => 'Chữ ký không hợp lệ']);
        }
    }
}
