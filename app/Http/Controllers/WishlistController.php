<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
{
    $user = Auth::user(); // Get the authenticated user
    
    if (!$user) {
        return response()->json(['success' => false, 'message' => 'You must be logged in to add to wishlist.']);
    }

    $productId = $request->input('product_id');
    $product = Product::find($productId);

    if (!$product) {
        return response()->json(['success' => false, 'message' => 'Product not found.']);
    }

    // Check if product is already in the wishlist
    $existingWishlist = Wishlist::where('user_id', $user->id)
        ->where('product_id', $productId)
        ->first();

    if ($existingWishlist) {
        return response()->json(['success' => false, 'message' => 'Product is already in your wishlist.']);
    }

    // Add the product to the wishlist
    $wishlist = new Wishlist();
    $wishlist->user_id = $user->id;
    $wishlist->product_id = $productId;
    $wishlist->save();

    return response()->json(['success' => true]);
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

}
