<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                Password::min(8)
                    ->letters()    // Bao gồm chữ cái
                    ->mixedCase()  // Bao gồm chữ hoa và chữ thường
                    ->numbers()    // Bao gồm số
                    ->symbols(),
                'confirmed'
            ],
        ], ['current_password.required' => 'Mật khẩu hiện tại không được để trống.', 'current_password.current_password' => 'Mật khẩu hiện tại không đúng.', 'password.required' => 'Mật khẩu mới không được để trống.', 'password.confirmed' => 'Xác nhận mật khẩu không khớp.', 'password.min' => 'Mật khẩu mới phải có ít nhất :min ký tự.', 'password.regex' => 'Mật khẩu mới không được chứa khoảng trắng.',]);


        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'Mật khẩu được cập nhật thành công');
    }
}
