<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index () {
        // Lấy các sản phẩm yêu thích của người dùng
    $user_id = auth()->id(); // Lấy ID người dùng hiện tại
    $favourites = Wishlist::where('user_id', $user_id)->get();  // Lấy sản phẩm yêu thích của người dùng

    // Lấy thông tin sản phẩm và hình ảnh tương ứng
    $products = [];
    $images = [];

    foreach ($favourites as $favourite) {
        $product = Product::find($favourite->product_id);  // Tìm sản phẩm theo product_id
        $image = ProductImage::where('product_id', $product->product_id)->first();  // Lấy hình ảnh đầu tiên của sản phẩm

        if ($product) {
            $products[] = $product;
            $images[] = $image;  // Lưu hình ảnh tương ứng với sản phẩm
        }
    }
        return view('users/favourite', compact('favourites','products', 'images'));
    }
    public function addToWishlist(Request $request)
    {
        $userId = auth()->id();  // Lấy ID người dùng đang đăng nhập
        $productId = $request->product_id;

        // Kiểm tra xem sản phẩm đã có trong wishlist của người dùng chưa
        $wishlist = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();

        if (!$wishlist) {
            // Nếu chưa có, thêm vào wishlist
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId
            ]);
        }

        // Lấy số lượng yêu thích hiện tại của người dùng
        $wishlistCount = Wishlist::where('user_id', $userId)->count();

        return response()->json(['success' => true, 'wishlistCount' => $wishlistCount]);
    }

    public function removeFromWishlist(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'You must be logged in to remove from wishlist.']);
        }

        $productId = $request->input('product_id');
        $wishlistItem = Wishlist::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return response()->json(['success' => true, 'message' => 'Product removed from wishlist']);
        }

        return response()->json(['success' => false, 'message' => 'Product not found in your wishlist']);
    }


    public function getWishlist()
    {
        $user = Auth::user();

        if ($user) {
            // Get the product IDs of the user's wishlist
            $wishlist = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();

            return response()->json(['wishlist' => $wishlist]);
        }

        return response()->json(['wishlist' => []]);
    }

    public function getWishlistCount()
    {
        $userId = auth()->id();  // Lấy ID người dùng
        $wishlistCount = Wishlist::where('user_id', $userId)->count();  // Đếm số lượng sản phẩm yêu thích

        return response()->json(['success' => true, 'wishlistCount' => $wishlistCount]);
    }
}
