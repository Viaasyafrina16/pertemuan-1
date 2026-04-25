<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        // withCount('products') akan otomatis membuat variabel 'products_count'
        $categories = Kategori::withCount('products')->get();
        return view('category.index', compact('categories'));
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('category.create');
    }

    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:kategoris,name|max:255',
        ]);

        Kategori::create($request->all());

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    }


}