<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;

class ProductController extends Controller
{
    public function getProducts()
    {
        // Lấy tất cả sản phẩm từ database
        $products = Product::orderBy('created_at', 'desc')->paginate(5);
        $images = [];

        foreach ($products as $product) {
            $images[] = ProductImage::where('product_id', $product->product_id)->first();
        }

        return compact('products', 'images');
    }

    public function getLatestProducts()
    {
        // Lấy 8 sản phẩm mới nhất
        $products = Product::latest()->take(8)->get();

        // Lấy hình ảnh tương ứng với các sản phẩm
        $images = [];
        foreach ($products as $product) {
            $images[] = ProductImage::where('product_id', $product->product_id)->first();
        }

        return compact('products', 'images');
    }

    public function product()
    {
        // Lấy dữ liệu sản phẩm và hình ảnh
        $data = $this->getProducts();

        // Trả về view product trong thư mục users
        return view('users.product', $data);
    }

    // Hiển thị danh sách sản phẩm
    public function index()
    {
        // // Lấy tất cả sản phẩm từ database
        // $products = Product::all();
        // $images = [];
        // foreach ($products as $product) {
        //     $images[] = ProductImage::where('product_id', $product->product_id)
        //         ->first();
        // }
        // return view('users/product', compact('products', 'images'));

        // Lấy dữ liệu sản phẩm và hình ảnh
        $data = $this->getLatestProducts();

        // Trả về view home trong thư mục users
        return view('users.home', $data);
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
        // $product = Product::findOrFail($id);
        $product = Product::with(['images', 'productVariants.size', 'productVariants.color'])->findOrFail($id); // Eager loading images

        // Lấy các sản phẩm liên quan (có thể là sản phẩm mới nhất hoặc theo tiêu chí nào đó)
        // Lấy các sản phẩm và hình ảnh mới nhất
        $relatedProductsData = $this->getLatestProducts();
        $relatedProducts = $relatedProductsData['products'];
        $relatedImages = $relatedProductsData['images'];

        return view('users\product-detail', compact('product', 'relatedProducts', 'relatedImages'));
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
    // tìm kiếm
    public function search(Request $request)
    {
        $query = $request->input('search'); // Lấy từ khóa tìm kiếm từ request

        if ($query) {
            // Tìm kiếm sản phẩm qua Model
            $products = Product::searchProducts($query);

            // Nếu không có sản phẩm tìm được
            if ($products->isEmpty()) {
                session()->flash('message', 'No products found for your search.');
            }
        } else {
            // Nếu không có từ khóa tìm kiếm, trả về tất cả sản phẩm
            $products = Product::with('images')->get(); // Eager load hình ảnh
        }

        return view('products.search-results', compact('products', 'query'));
    }
    // gợi ý tìm kiếm
    public function suggestions(Request $request)
    {
        $query = $request->input('query'); // Lấy từ khóa nhập vào

        // Lấy gợi ý sản phẩm từ Model
        $suggestions = Product::getSuggestions($query);

        return response()->json($suggestions);
    }
}
