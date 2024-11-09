<?php

namespace App\Http\Controllers;

use App\Models\Danhmuc;
use Illuminate\Http\Request;

class DanhmucController extends Controller
{
    public function getAllDanhMuc()
    {
        return DanhMuc::all();
    }

    public function AllDanhMuc()
    {
        $danhmucs = DanhMuc::all();
        return view('/admin/danhmuc-list', compact('danhmucs'));
    }

    // public function create()
    // {
    //     return view('danhmuc.create');
    // }

    public function store(Request $request)
    {
        $messages = [
            'danhmuc_Ten.required' => 'Vui lòng điền đầy đủ thông tin.',
            'danhmuc_Ten.max' => 'Thông tin tối đa 20 ký tự.',
            'danhmuc_Ten.regex' => 'Danh mục không được bao gồm số hay ký tự đặc biệt..',
        ];

        $request->validate([
            'danhmuc_Ten' => 'required|string|max:20|regex:/^[A-Z a-z]+$/',
        ], $messages);
        $data = $request->all();
        Danhmuc::create([
            'danhmuc_Ten' => $data['danhmuc_Ten'],
        ]);
        return redirect()->route('danhmuc.index')->with('success', 'Thêm thành công');
    }

    public function edit($id)
    {
        $danhmuc = Danhmuc::findOrFail($id);
        return view('/admin/danhmuc-edit', compact('danhmuc'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'danhmuc_Ten.required' => 'Vui lòng điền đầy đủ thông tin.',
            'danhmuc_Ten.max' => 'Thông tin tối đa 20 ký tự.',
            'danhmuc_Ten.regex' => 'Danh mục không được bao gồm số hay ký tự đặc biệt.',
        ];

        $request->validate([
            'danhmuc_Ten' => 'required|string|max:20|regex:/^[A-Z a-z]+$/',
        ], $messages);


        $danhmuc = Danhmuc::findOrFail($id);
        $danhmuc->danhmuc_Ten = $request->input('danhmuc_Ten');
        $danhmuc->save();
        
        return redirect()->route('danhmuc.index')->with('success', 'Sửa thành công');
    }

    public function destroy($id)
    {
        $danhmuc = Danhmuc::findOrFail($id);
        $danhmuc->delete();
        return redirect()->route('danhmuc.index')->with('success', 'Xóa thành công');
    }
}



