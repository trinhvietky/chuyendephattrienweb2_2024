<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        // Lấy tất cả sản phẩm từ database
        $products = Product::all();
        $images = [];
        foreach ($products as $product) {
            $images[] = ProductImage::where('product_id', $product->product_id)
                ->first();
        }
        return view('users/product', compact('products', 'images'));
    }

    // Hiển thị form thêm sản phẩm
    public function create()
    {
        // Lấy danh mục con để gán cho sản phẩm
        $subCategories = SubCategory::all();
        return view('admin/product-add', compact('subCategories'));
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
        return view('users\product-detail', compact('product'));
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

    //Lọc sản phẩm theo danh mục
    public function filterByCategory($subCategoryId)
    {
        // Lấy danh sách sản phẩm theo subCategory_id
        $products = Product::where('subCategory_id', $subCategoryId)->get();

        // Lấy hình ảnh đầu tiên cho từng sản phẩm
        $images = [];
        foreach ($products as $product) {
            $images[] = ProductImage::where('product_id', $product->product_id)
                ->first();
        }

        // Trả về view với danh sách sản phẩm đã lọc
        return view('users/product', compact('products', 'images'));
    }

    //Lọc sản phẩm theo giá
    public function filterByPrice(Request $request)
    {
        $order = $request->get('order', 'asc'); // Lấy thứ tự sắp xếp từ request, mặc định là 'asc'

        // Lấy danh sách sản phẩm sắp xếp theo giá
        $products = Product::orderBy('price', $order)->get();

        // Lấy hình ảnh đầu tiên cho từng sản phẩm
        $images = [];
        foreach ($products as $product) {
            $images[] = ProductImage::where('product_id', $product->product_id)->first();
        }

        return view('users/product', compact('products', 'images', 'order'));
    }


}
