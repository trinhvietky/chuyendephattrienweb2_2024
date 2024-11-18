<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Lấy tất cả dữ liệu từ bảng size
        $sizes = Size::paginate(2);

        // Trả dữ liệu về view
        return view('admin.size-list', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate(
            [
                'size_name' => [
                    'required',
                    'string',
                    'max:10',
                    'regex:/^[A-Za-z0-9\-]+$/',
                ],
            ],
            [
                'size_name.required' => 'Tên size là bắt buộc. Vui lòng điền đầy đủ thông tin',
                'size_name.unique' => 'Tên là duy nhất.',
                'size_name.regex' => 'Tên chỉ được phép chứa các ký tự chữ cái, số và dấu gạch ngang, không được chứa khoảng trắng hoặc ký tự đặc biệt khác.',
                'size_name.max' => 'Tên size có độ dài là 10 ký tự. Vui lòng kiểm tra lại.',
            ]
        );

        // Create a new user
        $size = Size::create([
            'size_name' => $validated['size_name'],
        ]);

        // Redirect to a specific page after saving
        return redirect()->route('size-list')->with('success', 'Size added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Lấy thông tin user theo id
        $size = Size::where('size_id', $id)->first();

        // Trả dữ liệu về view edit
        return view('admin.size-edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Tìm user theo ID
        $size = Size::where('size_id', $id)->first();

         // Validate the incoming request data
         $validated = $request->validate(
            [
                'size_name' => [
                    'required',
                    'string',
                    'max:10',
                    'regex:/^[A-Za-z0-9\-]+$/',
                ],
            ],
            [
                'size_name.required' => 'Tên size là bắt buộc. Vui lòng điền đầy đủ thông tin',
                'size_name.unique' => 'Tên là duy nhất.',
                'size_name.regex' => 'Tên chỉ được phép chứa các ký tự chữ cái, số và dấu gạch ngang, không được chứa khoảng trắng hoặc ký tự đặc biệt khác.',
                'size_name.max' => 'Tên size có độ dài là 10 ký tự. Vui lòng kiểm tra lại.',
            ]
        );

        // Cập nhật các thông tin khác
        $size->size_name = $request->input('size_name');

        // Lưu thay đổi
        $size->save();

        // Chuyển hướng lại trang danh sách với thông báo thành công
        return redirect()->route('size-list')->with('success', 'Thông tin size đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Tìm user theo ID
        $size = Size::where('size_id', $id)->first();

        // Xóa user
        $size->delete();

        // Sau khi xóa, chuyển hướng về trang danh sách người dùng với thông báo thành công
        return redirect()->route('size-list')->with('success', 'Size đã được xóa thành công.');
    }

    public function getSizes()
    {
        $sizes = Size::all();
        return response()->json($sizes);
    }
}
