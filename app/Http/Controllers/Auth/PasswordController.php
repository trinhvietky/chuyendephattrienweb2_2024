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
            'password' => ['required', 
            Password::min(8)
                ->letters()    // Bao gồm chữ cái
                ->mixedCase()  // Bao gồm chữ hoa và chữ thường
                ->numbers()    // Bao gồm số
                ->symbols(), 'confirmed'],
        ]);


        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'Mật khẩu được cập nhật thành công');
    }
}
