<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function showForm()
    {
        return view('users/address');
    }
    public function showFormProfile()
    {
        return view('profile.edit');
    }

    // Hàm thêm địa chỉ
    public function saveAddress(Request $request)
    {
        // Lấy user_id từ session hoặc Auth
        $userId = auth()->id();

        // Gọi hàm xử lý từ model
        $address = Address::saveNewAddress($request->all(), $userId);

        if ($address) {
            return redirect()->back()->with('success', 'Địa chỉ đã được lưu thành công!');
        }
    }
    // Controller method để cập nhật địa chỉ
    public function update(Request $request)
    {
        $user = $request->user();

        // Kiểm tra xem người dùng có chọn làm mặc định không
        $isDefault = $request->has('is_default') && $request->is_default === 'on';

        // Cập nhật địa chỉ bằng cách gọi hàm updateAddress từ Address model
        $address = Address::updateAddress($request->all(), $request->address_id, $user->id);

        if ($address) {
            return redirect()->route('profile.edit')->with('success', 'Địa chỉ đã được cập nhật');
        }

        return redirect()->route('profile.edit')->with('error', 'Có lỗi xảy ra khi cập nhật địa chỉ');
    }
    // Hàm xóa địa chỉ
    public function destroy(Request $request)
    {
        $address = Address::where('id', $request->input('address_id'))->where('user_id', auth()->id())->first();

        if ($address) {
            $address->delete();
            return response()->json(['message' => 'Địa chỉ đã được xóa thành công.']);
        }

        return response()->json(['message' => 'Không tìm thấy địa chỉ.'], 404);
    }
}
