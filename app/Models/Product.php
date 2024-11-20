<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    // use HasFactory, Searchable;
    protected $primaryKey = 'product_id'; // Đặt khóa chính là product_id

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'subCategory_id',
    ];
    // Định nghĩa hàm tìm kiếm Full-Text
    public static function search($query)
    {
        return self::whereRaw("MATCH(product_name, description) AGAINST(? IN BOOLEAN MODE)", [$query])->get();
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subCategory_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function toSearchableArray()
    {
        return [
            'product_name' => $this->product_name,
            'description' => $this->description,
            'price' => $this->price,
        ];
    }
    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id'); // Giả sử khóa ngoại là 'product_id'
    }
    // Phương thức tìm kiếm sản phẩm
    public static function searchProducts($query)
    {
        if ($query) {
            // Tìm kiếm qua Laravel Scout (nếu có)
            $productsFromSearchEngine = Product::search($query);

            // Tìm kiếm Full-Text trong cơ sở dữ liệu MySQL
            $productsFromDatabase = Product::whereRaw("MATCH(product_name, description) AGAINST(? IN BOOLEAN MODE)", [$query])
                ->orderByRaw("MATCH(product_name, description) AGAINST(?) DESC", [$query])
                ->with('images') // Eager load hình ảnh
                ->get();

            // Kết hợp kết quả từ cả Search Engine và cơ sở dữ liệu
            return $productsFromSearchEngine->merge($productsFromDatabase);
        }

        return collect(); // Trả về một tập rỗng nếu không có từ khóa
    }

    // Phương thức gợi ý sản phẩm
    public static function getSuggestions($query)
    {
        if ($query) {
            // Tìm kiếm sản phẩm qua Full-Text Search
            $suggestions = Product::whereRaw("MATCH(product_name, description) AGAINST(? IN BOOLEAN MODE)", [$query])
                ->orderByRaw("MATCH(product_name, description) AGAINST(?) DESC", [$query])
                ->with('images') // Eager load hình ảnh
                ->take(5) // Giới hạn số gợi ý
                ->get();

            // Chỉ lấy thông tin cần thiết: ID sản phẩm, tên, giá, mô tả và hình ảnh
            return $suggestions->map(function ($product) {
                $imagePath = $product->images->isNotEmpty() ? url($product->images->first()->image_path) : null;
                return [
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'price' => $product->price,
                    'description' => $product->description,
                    'image_path' => $imagePath
                ];
            });
        }

        return collect(); // Trả về mảng rỗng nếu không có từ khóa
    }
}
