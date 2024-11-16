<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id'; // Đặt khóa chính là product_id

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'subCategory_id',
    ];

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

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id'); // Giả sử khóa ngoại là 'product_id'
    }
}
