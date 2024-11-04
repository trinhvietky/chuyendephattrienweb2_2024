<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class AddressController extends Controller
{
    public function index()
    {
        return view('users/address');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tinh' => 'required|string|max:255', // Thêm xác thực cho Tỉnh
            'quan' => 'required|string|max:255', // Thêm xác thực cho Quận
            'phuong' => 'required|string|max:255', // Thêm xác thực cho Phường
        ]);
    
        Address::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'tinh_id' => $request->tinh, // Lưu Tỉnh
            'quan_id' => $request->quan, // Lưu Quận
            'phuong_id' => $request->phuong, // Lưu Phường
        ]);

        return redirect()->route('users/address')->with('success', 'Địa chỉ đã được thêm thành công.');
    }

}
