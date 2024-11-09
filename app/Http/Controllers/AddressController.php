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
        if ($request->has('is_default') && $request->input('is_default') == '1') {
            // Nếu chọn, đặt địa chỉ này là mặc định và đảm bảo không có địa chỉ nào khác là mặc định
            Address::where('user_id', auth()->id())->update(['is_default' => false]);
            $address->is_default = true;
        } else {
            // Nếu không chọn, để địa chỉ này không phải mặc định
            $address->is_default = false;
        }

        $address->save();


        return response('Địa chỉ đã được lưu thành công');
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
    
        // Cập nhật địa chỉ
        $address = Address::find($request->address_id);
        $address->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'phuong' => $request->phuong,
            'quan' => $request->quan,
            'tinh' => $request->tinh,
            'is_default' => $isDefault ? true : false,
        ]);
    
        return redirect()->route('profile.edit')->with('success', 'Địa chỉ đã được cập nhật');
    }
    


}




