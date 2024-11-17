<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'color_id' => 'required|exists:colors,color_id',
            'size_id' => 'required|exists:sizes,size_id',
            'quantity' => 'required|integer|min:1',
        ]);



        $productVariant = ProductVariant::where('color_id', $validatedData['color_id'])
            ->where('size_id', $validatedData['size_id'])
            ->first();

        // dd($productVariant);
        if ($productVariant) {
            $productVariantId = $productVariant->productVariant_id;
        }
        // Get the authenticated user
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Check if the product variant already exists in the cart
        $cartItem = Cart::where('user_id', $user->id)
            ->where('productVariant_id', $productVariantId)
            ->first();

        if ($cartItem) {
            // Update the quantity if it exists
            $cartItem->quantity += $validatedData['quantity'];
            $cartItem->save();

            return response()->json([
                'message' => 'Cart updated successfully',
                'cart' => $cartItem,
            ], 200);
        }

        // Otherwise, create a new cart item
        $cartItem = Cart::create([
            'user_id' => $user->id,
            'productVariant_id' => $productVariantId,
            'quantity' => $validatedData['quantity'],
        ]);

        return response()->json([
            'message' => 'Item added to cart successfully',
            'cart' => $cartItem,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $carts = Cart::where('user_id', $user_id)->get();
        $images = [];
        foreach ($carts as $cart) {
            $images[] = ProductImage::where('product_id', $cart->productVariant->product->product_id)
                ->where('color_id', $cart->productVariant->color->color_id)
                ->first();
        }
        return view('users/shoping-cart', compact('carts', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cartId)
    {
        $cart = Cart::findOrFail($cartId);
        $cart->quantity = $request->input('quantity');
        $cart->save();

        // Tính lại tổng tiền cho giỏ hàng của người dùng
        $total = $cart->productVariant->product->price * $cart->quantity;

        // Trả về dữ liệu mới, bao gồm tổng tiền đã được định dạng
        return response()->json([
            'message' => 'Cập nhật số lượng thành công!',
            'totalFormatted' => number_format($total),
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->route('users/shoping-cart', ['user_id' => Auth::user()->id]);
    }

    // app/Http/Controllers/CartController.php
    public function getCartCount()
    {
        // Lấy tổng số lượng sản phẩm trong giỏ hàng
        $cartCount = Cart::sum('quantity'); // Tổng số lượng sản phẩm trong giỏ hàng

        // Trả về kết quả dưới dạng JSON
        return response()->json(['count' => $cartCount]);
    }
}
