<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterSendOTPMail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterOTPController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:10',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Tạo mã OTP
        $otp = mt_rand(100000, 999999);

        // Lưu thông tin người dùng tạm thời vào cơ sở dữ liệu
        DB::table('register_authentic')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(2),
            'created_at' => now(),
        ]);

        // Gửi email chứa mã OTP
        Mail::to($request->email)->send(new RegisterSendOTPMail($otp));

        // Lưu email vào session để xác thực sau này
        Session::put('otp_email', $request->email);

        // Chuyển hướng đến trang nhập mã OTP
        return redirect()->route('auth.verify.otp')->with('status', __('Vui lòng kiểm tra email của bạn để nhập mã OTP.'));
    }

    // Hiển thị form nhập OTP
    public function showOtpForm(Request $request)
    {
        $email = $request->session()->get('otp_email');
        return view('auth.verify-otp')->with('email', $email);
    }

    public function resendOtp(Request $request)
    {
        // Lấy email người dùng từ session
        $email = Session::get('otp_email');

        if (!$email) {
            return redirect()->route('auth.register')->withErrors('Không tìm thấy email. Vui lòng đăng ký lại.');
        }

        // Tạo mã OTP mới
        $otp = mt_rand(100000, 999999);

        // Cập nhật mã OTP mới trong cơ sở dữ liệu
        DB::table('register_authentic')
            ->where('email', $email)
            ->update([
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(1),
            ]);

        // Gửi email chứa mã OTP mới
        Mail::to($email)->send(new RegisterSendOTPMail($otp));

        // Reset lại thời gian OTP và hiển thị thông báo
        return response()->json(['status' => 'Mã OTP đã được gửi lại!']);
    }

    // Xác thực mã OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $email = Session::get('otp_email');

        // Lấy thông tin người dùng tạm thời
        $tempUser = DB::table('register_authentic')->where('email', $email)->first();

        if ($tempUser && $tempUser->otp == $request->otp && now() <= $tempUser->otp_expires_at) {
            // Tạo tài khoản người dùng mới
            User::create([
                'name' => $tempUser->name,
                'email' => $tempUser->email,
                'phone' => $tempUser->phone,
                'password' => $tempUser->password,
            ]);

            // Xóa thông tin tạm thời
            DB::table('register_authentic')->where('email', $email)->delete();

            return redirect()->route('login')->with('success', 'Đăng ký thành công!');
        } else {
            return back()->withErrors(['otp' => __('Mã OTP không hợp lệ hoặc đã hết hạn.')]);
        }
    }
}