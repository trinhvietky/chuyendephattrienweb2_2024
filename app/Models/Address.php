<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Chỉ định tên bảng
    protected $table = 'address'; // Đảm bảo khớp với tên bảng trong cơ sở dữ liệu

    // Các thuộc tính khác nếu cần
    protected $fillable = ['name', 'user_id', 'tinh', 'quan', 'phuong']; // Danh sách các thuộc tính có thể gán
}
