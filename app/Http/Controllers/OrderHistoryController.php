<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view your order history.');
        }
        $status = $request->input('status', 'all');
        $query = Order::where('user_id', $user->id);
        if ($status != 'all') {
            $query->where('status', $status);
        }
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('order-history', compact('orders', 'status'));
    }
}
