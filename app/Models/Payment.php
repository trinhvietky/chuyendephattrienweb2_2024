<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Tên bảng (nếu không sử dụng chuẩn đặt tên của Laravel)
    protected $table = 'payments';

    // Khóa chính
    protected $primaryKey = 'payment_id';

    // Các cột có thể gán giá trị hàng loạt
    protected $fillable = [
        'order_id',
        'amount',
        'payment_method',
        'payment_status',
    ];

    // Liên kết với bảng Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
