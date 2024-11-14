<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Address;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $address = Address::where('user_id', $user->id)->get();
    
        return view('profile.edit', [
        'user' => $user,
        'addresses' => $address,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function updateAvatar(Request $request)
{
    // Lấy người dùng hiện tại
    $user = $request->user();

    // Kiểm tra nếu có ảnh được chọn
    if ($request->hasFile('image')) {

        // Xóa ảnh cũ nếu có
        if ($user->image && file_exists(public_path($user->image))) {
            unlink(public_path($user->image));  // Xóa ảnh cũ
        }

        // Lấy file ảnh mới
        $file = $request->file('image');

        // Tạo tên file duy nhất
        $filename = 'avatar_' . time() . '.' . $file->getClientOriginalExtension();

        // Lưu ảnh vào thư mục public/img/avatar_user
        $file->move(public_path('img/avatar_user'), $filename);

        // Cập nhật đường dẫn ảnh vào cơ sở dữ liệu
        $user->image = 'img/avatar_user/' . $filename;

        // Lưu vào cơ sở dữ liệu
        $user->save();
    }

    // Trả về URL ảnh mới đã được cập nhật
    return response()->json(['image_url' => asset($user->image)]);
}    

}
