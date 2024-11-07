<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phuong extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'quan_id'];

    public function quan()
    {
        return $this->belongsTo(Quan::class);
    }
}
