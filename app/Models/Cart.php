<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Đặt tên cho khóa chính nếu khác với 'id'
    protected $primaryKey = 'cart_id';

    // Các cột có thể được fillable
    protected $fillable = [
        'user_id',
        'productVariant_id',
        'quantity',
    ];

    /**
     * Liên kết tới model User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Liên kết tới model ProductVariant
     */
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'productVariant_id');
    }
}
