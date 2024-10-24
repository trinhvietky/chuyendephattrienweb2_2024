<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\Product;
use App\Models\Color;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    // Hiển thị danh sách các biến thể sản phẩm
    public function index()
    {
        // Hiển thị danh sách sản phẩm
        $productVariants = ProductVariant::all();
        $images = [];
        foreach ($productVariants as $variant) {
            $images[] = ProductImage::where('product_id', $variant->product->product_id)
                ->where('color_id', $variant->color->color_id)
                ->first();
        }

        // dd($images);


        // Truyền cả hai biến vào view
        return view('admin/product-variant-list', compact('productVariants', 'images'));
    }


    // Hiển thị form để tạo biến thể sản phẩm mới
    public function create()
    {
        // $products = Product::findOrFail($product_id);
        $colors = Color::all();
        $sizes = Size::all();
        $subCategories = SubCategory::all();
        return view('admin/product-variant-add', compact('colors', 'sizes', 'subCategories'));
    }

    // Lưu biến thể sản phẩm mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // dd($request->file('product_images'));

        // Validate dữ liệu
        $validatedData = $request->validate([
            'color_id' => 'required|exists:colors,color_id',
            'size_id.*' => 'required|exists:sizes,size_id',
            'stock.*' => 'required|integer|min:0',
            'product_images.*' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // Lấy product_id từ session
        $product_id = session('product_id');

        // Mảng để lưu ID của các biến thể sản phẩm
        $productVariantIds = [];

        // Lặp qua các size và stock để tạo biến thể
        foreach ($validatedData['size_id'] as $index => $sizeId) {
            $productVariant = ProductVariant::create([
                'product_id' => $product_id,
                'color_id' => $validatedData['color_id'],
                'size_id' => $sizeId,
                'stock' => $validatedData['stock'][$index], // Lấy stock tương ứng
            ]);
        }
        // Xử lý lưu hình ảnh nếu có
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $this->saveImage($image, $product_id, $validatedData['color_id']);
            }
        }

        return redirect()->route('admin/product_variants.index')->with('success', 'Biến thể sản phẩm đã được thêm');
    }


    // Hiển thị form để chỉnh sửa biến thể sản phẩm
    public function edit($id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $products = Product::all();
        $colors = Color::all();
        $sizes = Size::all();
        $subCategories = SubCategory::all();
        return view('admin/product-edit', compact('productVariant', 'products', 'colors', 'sizes', 'subCategories'));
    }

    // Cập nhật biến thể sản phẩm
    public function update(Request $request, $product_id)
    {
        // dd($request);
        $validatedData = $request->validate([
            'color_id' => 'required|exists:colors,color_id',
            'size_id' => 'required|exists:sizes,size_id',
            'stock' => 'required|integer|min:0',
        ]);

        $productVariant = ProductVariant::findOrFail($product_id);
        $productVariant->update([
            'product_id' => $product_id,
            'color_id' => $validatedData['color_id'],
            'size_id' => $validatedData['size_id'],
            'stock' => $validatedData['stock'],
        ]);

        return redirect()->route('product_variants.index')->with('success', 'Biến thể sản phẩm đã được cập nhật');
    }

    // Xóa biến thể sản phẩm
    public function destroy($id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->delete();

        return redirect()->route('product_variants.index')->with('success', 'Biến thể sản phẩm đã được xóa');
    }

    private function saveImage($image, $productVariantId, $colorId)
    {
        // Lưu ảnh vào thư mục
        $path = 'img/product/';
        $imageName = time() . '_' . rand(0, 999) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $imageName);

        // Lưu thông tin ảnh vào bảng Image
        ProductImage::create([
            'product_id' => $productVariantId, // ID biến thể sản phẩm
            'color_id' => $colorId,
            'image_path' => $path . $imageName,
            'alt_text' => 'Ảnh sản phẩm', // Tùy chỉnh văn bản thay thế
        ]);
    }

    public function deleteImage($imageId)
    {
        // Tìm ảnh dựa trên ID trong bảng ProductImage
        $productImages = ProductImage::find($imageId);

        if ($productImages) {
            // Lấy đường dẫn đầy đủ của ảnh cần xóa
            $fullImagePath = public_path($productImages->image_path);

            // Kiểm tra xem file có tồn tại trong thư mục hay không
            if (file_exists($fullImagePath)) {
                // Xóa ảnh từ thư mục
                unlink($fullImagePath);
            }

            // Xóa bản ghi ảnh từ bảng ProductImage
            $productImages->delete();

            // Thông báo thành công
            return back()->with('success', 'Ảnh đã được xóa thành công.');
        }

        // Nếu không tìm thấy ảnh, thông báo lỗi
        return back()->with('error', 'Không tìm thấy ảnh.');
    }
}
