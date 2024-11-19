<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Models\Tinh;
use App\Models\Quan;
use App\Models\Phuong;

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

    public function saveAddress(Request $request)
    {

        $address = new Address();
        $address->user_id = auth()->id();
        $address->name = $request->input('name');
        $address->phone = $request->input('phone');
        $address->tinh = $request->input('tinh');
        $address->quan = $request->input('quan');
        $address->phuong = $request->input('phuong');
        $address->address = $request->input('address');

        // Kiểm tra nếu người dùng đã chọn "mặc định" và chỉ cập nhật khi có chọn
        if ($request->filled('is_default') && $request->input('is_default') == '1') {
            // Nếu chọn, đặt địa chỉ này là mặc định và cập nhật các địa chỉ khác thành không mặc định
            Address::where('user_id', auth()->id())->update(['is_default' => false]);
            $address->is_default = true;
        } else {
            // Nếu không chọn, để mặc định là false
            $address->is_default = false;
        }

        $address->save();


        return redirect('Địa chỉ đã được lưu thành công');
    }
    // Controller method để cập nhật địa chỉ
    public function update(Request $request)
    {
        // Kiểm tra và chuyển giá trị 'on' thành true và 'off' thành false
        $isDefault = $request->has('is_default') && $request->is_default === 'on';

        // Nếu người dùng chọn làm mặc định, đặt tất cả các địa chỉ khác thành không phải mặc định
        if ($isDefault) {
            Address::where('user_id', auth()->id())
                ->update(['is_default' => false]);
        }

        // Lấy tên tỉnh từ API
        $tinh_name = "";
        if ($request->tinh != 0) {
            $tinh_response = file_get_contents('https://esgoo.net/api-tinhthanh/1/0.htm');
            $tinh_data = json_decode($tinh_response, true);
            foreach ($tinh_data['data'] as $tinh) {
                if ($tinh['id'] == $request->tinh) {
                    $tinh_name = $tinh['full_name'];  // Lấy tên tỉnh
                    break;
                }
            }
        }

        // Lấy tên quận từ API
        $quan_name = "";
        if ($request->quan != 0) {
            $quan_response = file_get_contents('https://esgoo.net/api-tinhthanh/2/' . $request->tinh . '.htm');
            $quan_data = json_decode($quan_response, true);
            foreach ($quan_data['data'] as $quan) {
                if ($quan['id'] == $request->quan) {
                    $quan_name = $quan['full_name'];  // Lấy tên quận
                    break;
                }
            }
        }

        // Lấy tên phường từ API
        $phuong_name = "";
        if ($request->phuong != 0) {
            $phuong_response = file_get_contents('https://esgoo.net/api-tinhthanh/3/' . $request->quan . '.htm');
            $phuong_data = json_decode($phuong_response, true);
            foreach ($phuong_data['data'] as $phuong) {
                if ($phuong['id'] == $request->phuong) {
                    $phuong_name = $phuong['full_name'];  // Lấy tên phường
                    break;
                }
            }
        }

        // Cập nhật địa chỉ
        $address = Address::find($request->address_id);
        if ($address) {
            $address->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'tinh' => $tinh_name,  // Lưu tên tỉnh
                'quan' => $quan_name,  // Lưu tên quận
                'phuong' => $phuong_name,  // Lưu tên phường
                'is_default' => $isDefault,
            ]);
        }

        return redirect()->route('profile.edit')->with('success', 'Địa chỉ đã được cập nhật');
    }
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
