<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Tên bảng (nếu không theo chuẩn Laravel)
    protected $table = 'orders';

    // Khóa chính
    protected $primaryKey = 'order_id';

    // Các cột có thể ghi dữ liệu
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'voucher_code',
    ];

    /**
     * Quan hệ với User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Quan hệ với Voucher
     */
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_code');
    }
}
