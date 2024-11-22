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

    // Kiểm tra nếu có file ảnh
    if ($request->hasFile('image')) {
        $file = $request->file('image');

        // Gọi phương thức trong model User
        $newImagePath = $user->updateAvatar($file);

        // Trả về JSON với đường dẫn ảnh
        return response()->json(['image_url' => asset($newImagePath)]);
    }

    // Trường hợp không có ảnh
    return response()->json(['error' => 'No image uploaded'], 400);
}

}
