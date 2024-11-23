<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        // $user = Auth::user();
        // if (!$user) {
        //     return redirect()->route('login')->with('error', 'Please login to view your order history.');
        // }
        // $status = $request->input('status', 'all');
        // $query = Order::where('user_id', $user->id);
        // if ($status != 'all') {
        //     $query->where('status', $status);
        // }
        // $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        // return view('users.order-history', compact('orders', 'status'));
        // Mảng ánh xạ trạng thái
        $statusMap = [
            'all' => null,
            'pending' => 1,
            'processing' => 2,
            'shipping' => 3,
            'completed' => 4,
            'cancelled' => 5,
        ];

        // Lấy trạng thái từ query string, mặc định là 'all'
        $status = $request->query('status', 'all');

        // Kiểm tra trạng thái có hợp lệ không
        if (!array_key_exists($status, $statusMap)) {
            abort(404); // Hoặc trả về trạng thái mặc định
        }

        // Lọc đơn hàng
        $orders = Order::where('user_id', auth()->id());
        if ($status !== 'all') {
            $orders->where('status', $statusMap[$status]); // Lọc theo trạng thái số
        }

        // Phân trang
        $orders = $orders->paginate(10);

        return view('users.order-history', compact('orders', 'status'));
    }
}
