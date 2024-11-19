<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function getAllDanhMuc()
    {
        return Categories::all();
    }

    public function AllDanhMuc()
    {
        $danhmucs = Categories::paginate(2);
        return view('/admin/danhmuc-list', compact('danhmucs'));
    }

    // public function create()
    // {
    //     return view('danhmuc.create');
    // }

    public function store(Request $request)
    {
        $messages = [
            'category_name.required' => 'Vui lòng điền đầy đủ thông tin.',
            'category_name.max' => 'Thông tin tối đa 20 ký tự.',
            'category_name.regex' => 'Danh mục không được bao gồm số hay ký tự đặc biệt..',
        ];

        $request->validate([
            'category_name' => 'required|string|max:20|regex:/^[A-Z a-zÀ-ỹ]+$/',
        ], $messages);
        $data = $request->all();
        Categories::create([
            'category_name' => $data['category_name'],
        ]);
        return redirect()->route('danhmuc.index')->with('success', 'Thêm thành công');
    }

    public function edit($id)
    {
        $danhmuc = Categories::findOrFail($id);
        return view('/admin/danhmuc-edit', compact('danhmuc'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'category_name.required' => 'Vui lòng điền đầy đủ thông tin.',
            'category_name.max' => 'Thông tin tối đa 20 ký tự.',
            'category_name.regex' => 'Danh mục không được bao gồm số hay ký tự đặc biệt.',
        ];

        $request->validate([
            'category_name' => 'required|string|max:20|regex:/^[A-Z a-zÀ-ỹ]+$/',
        ], $messages);


        $danhmuc = Categories::findOrFail($id);
        $danhmuc->category_name = $request->input('category_name');
        $danhmuc->save();
        
        return redirect()->route('danhmuc.index')->with('success', 'Sửa thành công');
    }

    public function destroy($id)
    {
        $danhmuc = Categories::findOrFail($id);
        $danhmuc->delete();
        return redirect()->route('danhmuc.index')->with('success', 'Xóa thành công');
    }
}



