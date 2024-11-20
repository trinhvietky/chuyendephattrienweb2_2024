<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductImage;
use App\Models\Voucher;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Lấy giỏ hàng từ session
        $carts = session('carts');
        $user = auth()->user();
        $listAddress = Address::where('user_id', $user->id)->get();
        $images = [];
        $totalQuantity = 0;
        foreach ($carts as $cart) {
            $totalQuantity += $cart->quantity;
            $images[] = ProductImage::where('product_id', $cart->productVariant->product->product_id)
                ->where('color_id', $cart->productVariant->color->color_id)
                ->first();
        }

        // dd($listAddress);
        // Trả lại view và truyền biến $carts vào view
        return view('users.checkout', compact('carts', 'images', 'totalQuantity', 'listAddress'));
    }

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

        // Validate request
        $request->validate([
            'email' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'shippingMethod' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'voucherCode' => 'nullable|string',
            'totalAmount' => 'numeric|min:0',
            'carts' => 'string',
            'addressId' => 'numeric'
        ]);
        // dd($request);
        // Lấy dữ liệu carts (chuỗi JSON)


        // Kiểm tra voucher (nếu có)
        // $voucher = null;
        // if ($request->voucher_code) {
        //     $voucher = Voucher::where('voucher_code', $request->voucher_code)
        //         ->where('status', 1) // Chỉ lấy voucher còn hiệu lực
        //         ->where('end_date', '>', now())
        //         ->first();
        // }

        // Nếu voucher hợp lệ và đáp ứng điều kiện
        // $discountAmount = 0;
        // if ($voucher && $voucher->minimum_order <= $request->total_amount) {
        //     $discountAmount = $voucher->discount_amount;
        // }

        $address = Address::where('id', $request->address_id);
        // // Tạo đơn hàng mới
        $order = new Order();
        $order->user_id = auth()->user()->id; // Nếu có người dùng đăng nhập
        $order->email = $request->email;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->shipping_method = $request->shippingMethod;
        $order->province = $address->tinh;
        // $order->district = $address->quan;
        // $order->ward = $address->phuong;
        // $order->specific_address = $address->address;
        // $order->note = $request->note;
        // $order->voucher_code = $request->voucher_code;
        // $order->total_amount = $request->total_amount; // Tổng sau giảm giá
        // $order->status = 0; // Chờ xử lý
        // $order->save();

        // // Lưu các sản phẩm trong giỏ hàng
        // // Lấy tất cả các sản phẩm trong giỏ hàng của người dùng
        // $carts = auth()->user()->carts;
        // foreach ($carts as $cart) {
        //     OrderItem::create([
        //         'order_id' => $order->id,
        //         'product_id' => $cart->product_id,
        //         'quantity' => $cart->quantity,
        //         'size_id' => $cart->productVariant->size->size_id,
        //         'color_id' => $cart->productVariant->color->color_id,
        //         'price' => $cart->price,
        //     ]);
        // }

        // Xóa giỏ hàng của người dùng
        // auth()->user()->carts()->delete();

        return response()->json([
            'message' => 'Item added to cart successfully',
            'cart' => $address,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function applyVoucher(Request $request)
    {
        // dd($request);
        // Validate the incoming request
        $request->validate([
            'voucher' => 'required|string',
            'cart_total' => 'required|numeric|min:0'
        ]);

        // Lấy thông tin mã giảm giá từ database
        $voucher = Voucher::where('voucher_code', $request->voucher)->first();

        // Kiểm tra nếu mã giảm giá không tồn tại
        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không tồn tại.',
            ]);
        }

        // Kiểm tra trạng thái của mã giảm giá (status = 1 nghĩa là hoạt động)
        if ($voucher->status !== 1) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không khả dụng.',
            ]);
        }

        // Kiểm tra ngày bắt đầu và ngày kết thúc của mã giảm giá
        $now = now();
        if ($now < $voucher->start_date) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá chưa được áp dụng.',
            ]);
        } else if ($now > $voucher->end_date) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá đã hết hạn.',
            ]);
        }

        // Kiểm tra giá trị đơn hàng tối thiểu (minimum_order)
        $cartTotal = $request->cart_total; // Giả định tổng tiền giỏ hàng được lưu trong session
        if ($cartTotal < $voucher->minimum_order) {
            return response()->json([
                'success' => false,
                'message' => 'Giá trị đơn hàng không đủ để áp dụng mã giảm giá.',
            ]);
        }

        // Kiểm tra số lần sử dụng (usage_limit)
        if ($voucher->usage_limit <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá đã đạt giới hạn sử dụng.',
            ]);
        }


        // Tính toán số tiền sau khi giảm
        $discountAmount = $voucher->discount_amount;
        $newTotal = max(0, $cartTotal - $discountAmount);

        // Trả về thông tin chi tiết
        return response()->json([
            'success' => true,
            'message' => 'Mã giảm giá áp dụng thành công!',
            'discount' => $discountAmount,
            'newTotal' => $newTotal,
        ]);
    }
}
