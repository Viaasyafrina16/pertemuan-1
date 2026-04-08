<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // 1. Izinkan kolom-kolom ini diisi (Mass Assignment)
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'user_id',
    ];

    // 2. Buat relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}