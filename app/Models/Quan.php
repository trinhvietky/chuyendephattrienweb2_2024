<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quan extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'tinh_id'];

    public function tinh()
    {
        return $this->belongsTo(Tinh::class);
    }

    public function phuongs()
    {
        return $this->hasMany(Phuong::class);
    }
}
