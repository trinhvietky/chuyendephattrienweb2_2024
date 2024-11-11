<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function index()
    {
        // Lấy tất cả dữ liệu từ bảng size
        $colors = Color::all();

        // Trả dữ liệu về view
        return view('admin/color-list', compact('colors'));
    }

    // Phương thức xóa size
    public function destroy($id)
    {
        // Tìm user theo ID
        $color = Color::where('color_id', $id)->first();

        // Xóa user
        $color->delete();

        // Sau khi xóa, chuyển hướng về trang danh sách người dùng với thông báo thành công
        return redirect()->route('color-list')->with('success', 'Color đã được xóa thành công.');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'color_name' => 'required|string|max:255',
        ], 
        [
            'color_name.required' => 'Tên là bắt buộc.',
        ]);

        // Create a new user
        $color = Color::create([
            'color_name' => $validated['color_name'],
        ]);

        // Redirect to a specific page after saving
        return redirect()->route('color-list')->with('success', 'Color added successfully!');
    }

    public function edit($id)
    {
        // Lấy thông tin user theo id
        $color = Color::where('color_id', $id)->first();

        // Trả dữ liệu về view edit
        return view('admin/color-edit', compact('color'));
    }

    public function update(Request $request, $id)
    {
        // Tìm user theo ID
        $color = Color::where('color_id', $id)->first();

        // Cập nhật các thông tin khác
        $color->color_name = $request->input('color_name');

        // Lưu thay đổi
        $color->save();

        // Chuyển hướng lại trang danh sách với thông báo thành công
        return redirect()->route('color-list')->with('success', 'Thông tin color đã được cập nhật thành công.');
    }
}
