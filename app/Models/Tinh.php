<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tinh extends Model
{
    use HasFactory;
    protected $table = 'tinhs';
    protected $fillable = ['name'];

    // public function quans()
    // {
    //     return $this->hasMany(Quan::class);
    // }
}
