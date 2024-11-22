<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['product_id', 'user_id', 'rating', 'content'];

    // Quan hệ với sản phẩm
    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}

    // Quan hệ với người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
