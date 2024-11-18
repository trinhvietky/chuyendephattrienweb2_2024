<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterOTPController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    //             ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    //Register OTP
    Route::get('/register', [RegisterOTPController::class, 'showRegistrationForm'])->name('auth.register');
    Route::post('/register', [RegisterOTPController::class, 'register'])->name('auth.register');
    // Route hiển thị form nhập mã OTP
    Route::get('/otp/auth.verify', [RegisterOTPController::class, 'showOtpForm'])->name('auth.verify.otp');

    // Route để xử lý việc xác minh OTP
    Route::post('/otp', [RegisterOTPController::class, 'verifyOtp'])->name('auth.verify.otp.post');
    // Route để xử lý gửi lại OTP
    Route::post('/resend-otp', [RegisterOTPController::class, 'resendOtp'])->name('auth.resend.otp');



    // Route cho trang quên mật khẩu
    Route::get('/auth/otp', [ForgotPasswordController::class, 'showOtpForm'])->name('auth.otp');
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    // Route cho trang nhập mã OTP
    Route::get('/auth/reset-password', [ForgotPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/check-otp', [ForgotPasswordController::class, 'checkOtp'])
        ->name('password.checkOtp');

    // Route cho trang đặt lại mật khẩu
    Route::post('/auth/reset-password', [ForgotPasswordController::class, 'update'])
        ->name('password.updated');

    // Route để xử lý gửi lại OTP
    Route::post('/resend-otp-forgot-password', [ForgotPasswordController::class, 'resendOTP'])->name('auth.password.resendOtp');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
