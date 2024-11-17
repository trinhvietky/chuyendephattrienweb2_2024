<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Trong app/Models/User.php
    public function updateAvatar($file)
    {
        // Xóa ảnh cũ nếu có
        if ($this->image && file_exists(public_path($this->image))) {
            unlink(public_path($this->image));
        }

        // Tạo tên file duy nhất
        $filename = 'avatar_' . time() . '.' . $file->getClientOriginalExtension();

        // Lưu file vào thư mục public/img/avatar_user
        $file->move(public_path('img/avatar_user'), $filename);

        // Cập nhật đường dẫn ảnh trong DB
        $this->image = 'img/avatar_user/' . $filename;

        // Lưu thay đổi vào DB
        $this->save();

        // Trả về đường dẫn ảnh mới
        return $this->image;
    }
}
