<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhmuc extends Model
{
    use HasFactory;

    protected $table = 'danhmuc';
    protected $primaryKey = 'danhmuc_ID';
    protected $fillable = ['danhmuc_Ten'];
}
