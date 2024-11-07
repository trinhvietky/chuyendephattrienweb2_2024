<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AdminController extends Controller
{
    public function index()
    {
        // Logic cho admin home page
        return view('admin/home');
    }
    // Phương thức xóa user
    public function AllUser()
    {
        // Lấy tất cả dữ liệu từ bảng users
        $users = User::all();

        // Trả dữ liệu về view
        return view('/admin/user-list', compact('users'));
    }
    public function destroy($id)
    {
        // Tìm user theo ID
        $user = User::findOrFail($id);

        // Xóa user
        $user->delete();

        // Sau khi xóa, chuyển hướng về trang danh sách người dùng với thông báo thành công
        return redirect()->route('admin/user-list')->with('success', 'User đã được xóa thành công.');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:10',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'Tên là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.unique' => 'Email này đã tồn tại.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        // Redirect to a specific page after saving
        return redirect()->route('admin/user-list')->with('success', 'User added successfully!');
    }

    public function edit($id)
    {
        // Lấy thông tin user theo id
        $user = User::findOrFail($id);
        // Trả dữ liệu về view edit
        return view('admin/user-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Tìm user theo ID
        $user = User::findOrFail($id);

        // Cập nhật các thông tin khác
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        // Nếu admin nhập mật khẩu mới thì hash và lưu lại
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Lưu thay đổi
        $user->save();

        // Chuyển hướng lại trang danh sách với thông báo thành công
        return redirect()->route('/admin/user-list')->with('success', 'Thông tin người dùng đã được cập nhật thành công.');
    }
}
