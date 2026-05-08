<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Menampilkan semua data produk
     * * Mengambil daftar seluruh produk yang tersedia beserta informasi kategorinya.
     */
    public function index()
    {
        try {
            // Mengambil semua produk beserta data kategorinya
            $products = Product::with('category')->get();
            
            return response()->json([
                'message' => 'Daftar produk berhasil diambil',
                'data' => $products
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data produk', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Menyimpan produk baru (Hanya untuk User yang Login)
     * * Menambahkan data produk baru ke dalam database. Membutuhkan token autentikasi.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $validated = $request->validated();

            // Menambahkan user_id dari user yang sedang login
            $validated['user_id'] = Auth::id();

            $product = Product::create($validated);

            Log::info('Menambah data produk', [
                'list' => $product
            ]);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan!!',
                'data' => $product,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah product', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Gagal menambah produk'], 500);
        }
    }

    /**
     * Menampilkan detail satu produk
     * * Mencari dan menampilkan informasi lengkap produk berdasarkan ID yang diberikan.
     */
    public function show(int $id)
    {
        try {
            $product = Product::with('category')->find($id);

            if (!$product)
            {
                return response()->json([
                    'message' => 'Product tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data produk', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Memperbarui data produk
     * * Mengubah informasi produk yang sudah ada berdasarkan ID.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Produk tidak ditemukan'], 404);
            }

            // Melakukan update data
            $product->update($request->all());

            Log::info('Memperbarui data produk', ['id' => $id]);

            return response()->json([
                'message' => 'Produk berhasil diperbarui!',
                'data' => $product,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui produk', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Gagal memperbarui produk'], 500);
        }
    }

    /**
     * Menghapus produk
     * * Menghapus data produk secara permanen dari database berdasarkan ID.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Produk tidak ditemukan'], 404);
            }

            $product->delete();

            Log::info('Menghapus data produk', ['id' => $id]);

            return response()->json([
                'message' => 'Produk berhasil dihapus'
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus produk', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Gagal menghapus produk'], 500);
        }
    }
}