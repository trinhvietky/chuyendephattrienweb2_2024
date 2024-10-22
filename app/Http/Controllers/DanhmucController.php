<?php

namespace App\Http\Controllers;

use App\Models\Danhmuc;
use Illuminate\Http\Request;

class DanhmucController extends Controller
{
    public function index()
    {
        $danhmucs = Danhmuc::all();
        return view('danhmuc.index', compact('danhmucs'));
    }

    public function create()
    {
        return view('danhmuc.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'danhmuc_Ten' => 'required|string|max:255',
        ]);

        Danhmuc::create($request->all());
        return redirect()->route('danhmuc.index')->with('success', 'Thêm thành công');
    }

    public function edit($id)
    {
        $danhmuc = Danhmuc::findOrFail($id);
        return view('danhmuc.edit', compact('danhmuc'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'danhmuc_Ten' => 'required|string|max:255',
        ]);

        $danhmuc = Danhmuc::findOrFail($id);
        $danhmuc->update($request->all());
        return redirect()->route('danhmuc.index')->with('success', 'Sửa thành công');
    }

    public function destroy($id)
    {
        $danhmuc = Danhmuc::findOrFail($id);
        $danhmuc->delete();
        return redirect()->route('danhmuc.index')->with('success', 'Xóa thành công');
    }
}
