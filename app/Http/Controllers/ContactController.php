<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $messages = [
            'msg.required' => 'Vui lòng nhập nội dung trước khi gửi.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.max:500' => 'không được nhập quá 500 ký tự.',
            'g-recaptcha-response.required' => 'Vui lòng xác minh reCAPTCHA.', 
            'g-recaptcha-response.captcha' => 'Xác minh reCAPTCHA không hợp lệ.',
        ];
        // Xác thực dữ liệu
        $request->validate([
            'email' => 'required|email',
            'msg' => 'required|max:500',
            'g-recaptcha-response' => 'required|captcha',
        ], $messages);

        // Lưu thông tin vào database (nếu cần)
        // Contact::create([
        //     'email' => $request->email,
        //     'message' => $request->msg
        // ]);

        // Gửi email
        Mail::to($request->email)->send(new ContactMail($request->email, $request->msg));

        // Quay lại với thông báo thành công
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
