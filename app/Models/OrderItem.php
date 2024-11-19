<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Tên bảng
    protected $table = 'order_items';

    // Khóa chính
    protected $primaryKey = 'orderitem_id';

    // Các cột có thể ghi dữ liệu
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'size_id',
        'color_id',
        'price',
    ];

    /**
     * Quan hệ với bảng Orders
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Quan hệ với bảng Products
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Quan hệ với bảng Sizes
     */
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    /**
     * Quan hệ với bảng Colors
     */
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
