<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;


    protected $table = 'kategoris';

    /**
     * Izinkan kolom 'name' untuk diisi secara massal.
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relasi: Satu Kategori memiliki banyak Produk (One-to-Many).

     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}