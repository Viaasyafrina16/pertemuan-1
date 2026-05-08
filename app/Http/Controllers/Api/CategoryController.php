<?php

namespace App\Http\Controllers\Api;

// Perbaikan: Menggunakan model Kategori sesuai dengan file App\Models\Kategori.php
use App\Models\Kategori; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Menampilkan semua data kategori
     * * Mengambil daftar seluruh kategori produk yang tersedia di dalam database.
     */
    public function index() {
        // Perbaikan: Menggunakan Kategori::all()
        return response()->json(['data' => Kategori::all()], 200);
    }

    /**
     * Membuat kategori baru
     * * Menambahkan data kategori baru ke dalam sistem. Membutuhkan input nama kategori.
     */
    public function store(Request $request) {
        // Perbaikan: Menggunakan Kategori::create()
        $category = Kategori::create($request->validate(['name' => 'required|string']));
        return response()->json(['message' => 'Kategori berhasil dibuat', 'data' => $category], 201);
    }

    /**
     * Menampilkan detail satu kategori
     * * Mencari dan menampilkan informasi lengkap mengenai satu kategori berdasarkan ID.
     */
    public function show($id) {
        // Perbaikan: Menggunakan Kategori::find()
        $category = Kategori::find($id);
        return $category ? response()->json(['data' => $category], 200) : response()->json(['message' => 'Not Found'], 404);
    }

    /**
     * Memperbarui data kategori
     * * Mengubah informasi nama kategori yang sudah ada berdasarkan ID yang dipilih.
     */
    public function update(Request $request, $id) {
        // Perbaikan: Menggunakan Kategori::find()
        $category = Kategori::find($id);
        if (!$category) return response()->json(['message' => 'Not Found'], 404);
        $category->update($request->validate(['name' => 'required|string']));
        return response()->json(['message' => 'Kategori berhasil diupdate'], 200);
    }

    /**
     * Menghapus kategori
     * * Menghapus data kategori dari database secara permanen berdasarkan ID.
     */
    public function destroy($id) {
        // Perbaikan: Menggunakan Kategori::find()
        $category = Kategori::find($id);
        if (!$category) return response()->json(['message' => 'Not Found'], 404);
        $category->delete();
        return response()->json(['message' => 'Kategori berhasil dihapus'], 200);
    }
}