<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ReviewController extends Controller
{
    public function storeReview(Request $request, $encoded_product_id)
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        $userId = auth()->id();

        // Validate dữ liệu
        $request->validate([
            'review' => 'required|string', // review vẫn là trường bắt buộc
        ]);

        // Giải mã ID sản phẩm từ URL
        try {
            $productId = Crypt::decryptString($encoded_product_id); // Giải mã ID sản phẩm
        } catch (\Exception $e) {
            abort(404, 'ID sản phẩm không hợp lệ');
        }

        // Lấy token từ URL
        $tokenFromUrl = request()->query('token');

        // Kiểm tra nếu token không tồn tại hoặc không hợp lệ
        if (!$tokenFromUrl) {
            abort(404);
        }

        // Kiểm tra token với token trong session
        $tokenFromSession = session('product_token');
        if ($tokenFromUrl !== $tokenFromSession) {
            abort(404, 'Token không hợp lệ hoặc đã hết hạn.');
        }

        // Kiểm tra xem review có tồn tại và thuộc về người dùng
        if ($request->has('review_id')) {
            // Cập nhật review
            $review = Review::findOrFail($request->input('review_id'));

            if ($review->user_id !== $userId) {
                abort(403, 'Unauthorized');
            }

            $review->update([
                'rating' => $request->input('rating'),
                'content' => $request->input('review'),
            ]);

            $message = 'Your review has been updated!';
        } else {
            // Lưu đánh giá mới
            Review::create([
                'product_id' => $productId,
                'user_id' => $userId,
                'rating' => $request->input('rating'),
                'content' => $request->input('review'),
            ]);

            $message = 'Your review has been submitted!';
        }

        // Quay lại trang chi tiết sản phẩm
        return redirect()->route('users/product-detail', ['product_id' => Crypt::encryptString($productId), 'token' => session('product_token')])
            ->with('success', $message);
    }


    public function edit($encoded_review_id)
    {
        try {
            // Giải mã ID review
            $review_id = Crypt::decryptString($encoded_review_id);
        } catch (\Exception $e) {
            abort(404, 'ID review không hợp lệ');
        }

        // Tìm review theo ID
        $review = Review::findOrFail($review_id);

        // Kiểm tra xem người dùng có phải là chủ sở hữu của review không
        if (auth()->id() !== $review->user_id) {
            abort(403, 'Unauthorized');
        }

        // Lấy token từ URL
        $tokenFromUrl = request()->query('token');

        // Kiểm tra nếu token không tồn tại hoặc không hợp lệ
        if (!$tokenFromUrl) {
            abort(404);
        }

        // Kiểm tra token với token trong session
        $tokenFromSession = session('product_token');
        if ($tokenFromUrl !== $tokenFromSession) {
            abort(404, 'Token không hợp lệ hoặc đã hết hạn.');
        }

        // Lấy thông tin sản phẩm từ product_id
        $product = Product::findOrFail($review->product_id); // Truy vấn sản phẩm từ ID sản phẩm

        // Mã hóa lại product_id
        $encodedProductId = Crypt::encryptString($review->product_id);

        // Đếm số lượng reviews của sản phẩm
        $reviewsCount = Review::where('product_id', $review->product_id)->count(); // Đếm số lượng reviews

        // Truy vấn các sản phẩm liên quan (cùng danh mục)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->product_id); // Không lấy sản phẩm hiện tại

        // Truyền dữ liệu vào view
        return view('users.product-detail', [
            'review' => $review, // Truyền review vào view
            'product' => $product, // Truyền đối tượng product vào view
            'encodedProductId' => $encodedProductId, // Mã hóa ID sản phẩm
            'token' => session('product_token'), // Token từ session
            'reviewsCount' => $reviewsCount, // Truyền số lượng reviews vào view
            'relatedProducts' => $relatedProducts, // Truyền các sản phẩm liên quan vào view
        ]);
    }

    public function update(Request $request, $review_id)
    {
        // Lấy thông tin người dùng hiện tại
        $userId = auth()->id();

        // Tìm review theo ID
        $review = Review::findOrFail($review_id);

        // Kiểm tra xem người dùng có phải là chủ sở hữu của review không
        if ($review->user_id !== $userId) {
            abort(403, 'Unauthorized');
        }

        // Validate dữ liệu đầu vào
        $request->validate([
            'review' => 'required|string',
        ]);

        // Cập nhật dữ liệu review
        $review->update([
            'content' => $request->input('review'),
            'rating' => $request->input('rating'),
        ]);

        // Chuyển hướng về trang chi tiết sản phẩm kèm thông báo thành công
        return redirect()->route('users/product-detail', [
            'product_id' => Crypt::encryptString($review->product_id),
            'token' => session('product_token'),
        ])->with('success', 'Your review has been updated successfully!');
    }


    public function destroy($encoded_review_id)
    {
        try {
            // Giải mã ID review
            $review_id = Crypt::decryptString($encoded_review_id);
        } catch (\Exception $e) {
            abort(404, 'ID review không hợp lệ');
        }

        // Tìm review theo ID
        $review = Review::findOrFail($review_id);

        // Kiểm tra xem người dùng có phải là chủ sở hữu của review không
        if (auth()->id() !== $review->user_id) {
            abort(403, 'Unauthorized');
        }

        // Lấy token từ URL
        $tokenFromUrl = request()->query('token');

        // Kiểm tra nếu token không tồn tại hoặc không hợp lệ
        if (!$tokenFromUrl) {
            abort(404);
        }

        // Kiểm tra token với token trong session
        $tokenFromSession = session('product_token');
        if ($tokenFromUrl !== $tokenFromSession) {
            abort(404, 'Token không hợp lệ hoặc đã hết hạn.');
        }

        // Lưu product_id để sử dụng sau khi xóa
        $productId = $review->product_id;

        // Xóa review
        $review->delete();

        // Mã hóa lại product_id
        $encodedProductId = Crypt::encryptString($productId);

        // Quay lại trang chi tiết sản phẩm sau khi xóa review
        return redirect()->route('users/product-detail', ['product_id' => $encodedProductId, 'token' => session('product_token')])
            ->with('success', 'Review deleted successfully');
    }
}
