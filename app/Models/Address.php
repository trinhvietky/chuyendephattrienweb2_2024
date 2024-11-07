<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Chỉ định tên bảng
    protected $table = 'address';
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'tinh',
        'quan',
        'phuong',
        'address',
        'is_default',
    ];
}
