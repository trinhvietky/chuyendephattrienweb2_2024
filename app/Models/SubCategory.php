<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'subCategory_id';
    protected $fillable = [
        'subCategory_name',
        'category_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
