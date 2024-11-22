<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Lưu bình luận
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,product_id',
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'content' => $request->content,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully!',
            'comment' => $comment,
        ]);
    }

    // Lấy danh sách bình luận cho sản phẩm
    public function fetch($product_id)
    {
        $comments = Comment::where('product_id', $product_id)->with('user')->latest()->get();

        return response()->json([
            'success' => true,
            'comments' => $comments,
        ]);
    }


    public function index($productId)
    {
        $comments = Comment::where('product_id', $productId)
            ->with('user') // Lấy thông tin người dùng liên quan
            ->latest()
            ->get();

        // Lấy thông tin sản phẩm
        $product = Product::findOrFail($productId);

        // Trả về view chi tiết sản phẩm
        return view('users.product-detail', compact('comments', 'product'));
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);  // Tìm comment theo ID
        // Kiểm tra nếu comment thuộc về người dùng đã đăng nhập
        if ($comment->user_id != auth()->id()) {
            return back()->with('error', 'You are not authorized to edit this comment.');
        }

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::findOrFail($id);  // Tìm comment theo ID
        // Kiểm tra nếu comment thuộc về người dùng đã đăng nhập
        if ($comment->user_id != auth()->id()) {
            return back()->with('error', 'You are not authorized to update this comment.');
        }

        $comment->update([
            'content' => $request->content,  // Cập nhật nội dung comment
        ]);

        return redirect()->route('products.show', $comment->product_id)
            ->with('success', 'Comment updated successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);  // Tìm comment theo ID
        // Kiểm tra nếu comment thuộc về người dùng đã đăng nhập
        if ($comment->user_id != auth()->id()) {
            return back()->with('error', 'You are not authorized to delete this comment.');
        }

        $comment->delete();  // Xóa comment

        return back()->with('success', 'Comment deleted successfully.');
    }


    public function getComments($productId)
    {
        $comments = Comment::where('product_id', $productId)
            ->with('user')
            ->latest()
            ->get();

        $commentsHtml = view('comments.list', compact('comments'))->render();

        return response()->json([
            'comments' => $commentsHtml,
        ]);
    }
}
