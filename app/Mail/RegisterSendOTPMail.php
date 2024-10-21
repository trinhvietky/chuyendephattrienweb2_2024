<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterSendOTPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->view('emails.register-send-otp') // Tên view email
                    ->subject('Mã OTP Đăng Ký Tài Khoản')
                    ->with(['otp' => $this->otp]); // Truyền dữ liệu OTP vào view
    }
}
