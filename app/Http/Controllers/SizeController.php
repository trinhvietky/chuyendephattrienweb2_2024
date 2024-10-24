<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        // Lấy tất cả dữ liệu từ bảng size
        $sizes = Size::all();

        // Trả dữ liệu về view
        return view('admin.size.size-list', compact('sizes'));
    }

    // Phương thức xóa size
    public function destroy($id)
    {
        // Tìm user theo ID
        $size = Size::where('size_id', $id)->first();

        // Xóa user
        $size->delete();

        // Sau khi xóa, chuyển hướng về trang danh sách người dùng với thông báo thành công
        return redirect()->route('size-list')->with('success', 'Size đã được xóa thành công.');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate(
            [
                'size_name' => [
                    'required',
                    'string',
                    'max:255'
                ],
            ],
            [
                'size_name.required' => 'Tên là bắt buộc.',
                'size_name.' => 'Tên là bắt buộc.',
            ]
        );

        // Create a new user
        $size = Size::create([
            'size_name' => $validated['size_name'],
        ]);

        // Redirect to a specific page after saving
        return redirect()->route('size-list')->with('success', 'Size added successfully!');
    }

    public function edit($id)
    {
        // Lấy thông tin user theo id
        $size = Size::where('size_id', $id)->first();

        // Trả dữ liệu về view edit
        return view('admin.size.size-edit', compact('size'));
    }

    public function update(Request $request, $id)
    {
        // Tìm user theo ID
        $size = Size::where('size_id', $id)->first();

        // Cập nhật các thông tin khác
        $size->size_name = $request->input('size_name');

        // Lưu thay đổi
        $size->save();

        // Chuyển hướng lại trang danh sách với thông báo thành công
        return redirect()->route('size-list')->with('success', 'Thông tin size đã được cập nhật thành công.');
    }
}
