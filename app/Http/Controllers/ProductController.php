<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        // Lấy tất cả sản phẩm từ database
        $products = Product::with('subCategory')->get(); // 'subCategory' là quan hệ giữa Product và Category
        return view('products.index', compact('products'));
    }

    // Hiển thị form thêm sản phẩm
    public function create()
    {
        // Lấy danh mục con để gán cho sản phẩm
        $subCategories = SubCategory::all();
        return view('product-add', compact('subCategories'));
    }

    // Lưu sản phẩm mới vào database
    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $validate = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'subCategory_id' => 'required|exists:sub_categories,subCategory_id'
        ]);
        // Tạo sản phẩm mới
        $product = Product::create($validate);
        // dd($product->product_id);
        // Lưu product_id vào session
        session(['product_id' => $product->product_id]);

        return redirect()->route('product_variants.create')->with('success', 'Sản phẩm đã được thêm');
    }

    // Hiển thị một sản phẩm cụ thể
    public function show($id)
    {
        // Lấy sản phẩm theo ID
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit($id)
    {
        // Lấy sản phẩm cần chỉnh sửa và danh mục con
        $product = Product::findOrFail($id);
        $subCategories = SubCategory::all();
        return view('products.edit', compact('product', 'subCategories'));
    }

    // Cập nhật thông tin sản phẩm
    public function update(Request $request, $id)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'sub_category_id' => 'required|exists:sub_categories,id'
        ]);

        // Cập nhật sản phẩm
        $product = Product::findOrFail($id);
        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'sub_category_id' => $request->sub_category_id,
        ]);

        // Chuyển hướng về danh sách sản phẩm
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật');
    }

    // Xóa sản phẩm
    public function destroy($id)
    {
        // Xóa sản phẩm theo ID
        $product = Product::findOrFail($id);
        $product->delete();

        // Chuyển hướng về danh sách sản phẩm
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa');
    }
}
