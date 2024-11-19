<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductImage;


class UserController extends Controller
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
    public function index()
    {
        $data = $this->getLatestProducts();
        return view('users/home', $data);
    }
}
