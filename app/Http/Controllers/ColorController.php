<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function index()
    {
        // Lấy tất cả dữ liệu từ bảng size
        $colors = Color::paginate(2);

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
        $validated = $request->validate(
            [
                'color_name' => [
                    'required',
                    'string',
                    'max:20',
                    'regex:/^[\pL0-9\s\-]+$/u', // Chỉ cho phép ký tự chữ cái, số, và dấu gạch ngang
                ],
            ],
            [
                'color_name.required' => 'Tên màu không được để trống. Vui lòng điền đầy đủ thông tin. ',
                'color_name.regex' => 'Tên màu chỉ được phép chứa các ký tự chữ cái, số và dấu gạch ngang, không được chứa ký tự đặc biệt khác.',
                'color_name.max' => 'Tên màu có độ dài là 20 ký tự. Vui lòng kiểm tra lại.',
            ]
        );
    
        // Create a new color record
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
        // Validate the incoming request data
        $validated = $request->validate(
            [
                'color_name' => [
                    'required',
                    'string',
                    'max:20',
                    'regex:/^[\pL0-9\s\-]+$/u', // Chỉ cho phép ký tự chữ cái, số, và dấu gạch ngang
                ],
            ],
            [
                'color_name.required' => 'Tên màu không được để trống. Vui lòng điền đầy đủ thông tin.',
                'color_name.regex' => 'Tên màu chỉ được phép chứa các ký tự chữ cái, số và dấu gạch ngang, không được chứa ký tự đặc biệt khác.',
                'color_name.max' => 'Tên màu có độ dài là 20 ký tự. Vui lòng kiểm tra lại.',
            ]
        );
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
