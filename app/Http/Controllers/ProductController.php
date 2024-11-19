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
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
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
    public function search(Request $request)
    {
        $query = $request->input('search'); // Lấy từ khóa tìm kiếm từ request

        if ($query) {
            // Tìm kiếm trên Search Engine (Laravel Scout)
            $productsFromSearchEngine = Product::search($query); // Không gọi get() ở đây, vì search đã trả về Collection rồi

            // Tìm kiếm Full-Text trong cơ sở dữ liệu MySQL
            $productsFromDatabase = Product::whereRaw("MATCH(product_name, description) AGAINST(? IN BOOLEAN MODE)", [$query])
                ->orderByRaw("MATCH(product_name, description) AGAINST(?) DESC", [$query])
                ->with('image') // Eager load hình ảnh
                ->get();

            // Kết hợp kết quả từ cả Search Engine và cơ sở dữ liệu
            $products = $productsFromSearchEngine->merge($productsFromDatabase);

            // Nếu không có sản phẩm tìm được
            if ($products->isEmpty()) {
                session()->flash('message', 'No products found for your search.');
            }
        } else {
            // Nếu không có từ khóa tìm kiếm, trả về tất cả sản phẩm
            $products = Product::with('image')->get(); // Eager load hình ảnh
        }

        return view('products.search-results', compact('products', 'query'));
    }
    public function searchSuggestions(Request $request)
    {
        $query = $request->input('query'); // Lấy từ khóa tìm kiếm từ request

        // Kiểm tra xem query có tồn tại không
        if (!$query) {
            return response()->json(['suggestions' => []]);
        }

        // Tìm kiếm trên Search Engine (Laravel Scout)
        $suggestionsFromSearchEngine = Product::search($query)
            ->limit(5) // Giới hạn số lượng gợi ý trả về, thay vì take(5)
            ->get() // Sử dụng get() của Scout
            ->pluck('product_name'); // Chỉ lấy tên sản phẩm

        // Trả về kết quả gợi ý
        return response()->json(['suggestions' => $suggestionsFromSearchEngine]);
    }
}