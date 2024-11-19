<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;
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

    public function image()
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
}
