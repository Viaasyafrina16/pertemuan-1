<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
// PENTING: Menambahkan trait ini agar method authorize() bisa digunakan
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 
// Memanggil Form Request untuk validasi
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // PENTING: Memasang trait AuthorizesRequests di dalam class
    use AuthorizesRequests;

    public function index()
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    // Method Export (Tugas Kelas B - Gate)
    public function export()
    {
        // Memastikan Gate mengizinkan akses
        if (!Gate::allows('export-product')) {
            abort(403, 'Hanya Admin yang dapat melakukan export data.');
        }

        // Logika export sederhana
        return redirect()->route('product.index')->with('success', 'Data berhasil di-export ke Excel (Simulasi)');
    }

    /**
     * Store menggunakan StoreProductRequest dengan penanganan error
     */
    public function store(StoreProductRequest $request)
    {
        // Mengambil data yang sudah lolos validasi
        $validated = $request->validated();

        // Mengambil ID user yang sedang login secara otomatis
        $validated['user_id'] = Auth::id();

        try {
            Product::create($validated);

            return redirect()
                ->route('product.index')
                ->with('success', 'Product created successfully.');
                
        } catch (QueryException $e) {
            Log::error('Product store database error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Database error while creating product.');
                
        } catch (\Throwable $e) {
            Log::error('Product store unexpected error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Unexpected error occurred.');
        }
    }

    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('product.create', compact('users'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.view', compact('product'));
    }

    /**
     * Update menggunakan UpdateProductRequest dengan proteksi Policy
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        // Proteksi Policy: Hanya pemilik yang boleh update
        $this->authorize('update', $product);

        // Mengambil data yang sudah lolos validasi dari UpdateProductRequest
        $validated = $request->validated();

        try {
            $product->update($validated);

            return redirect()
                ->route('product.index')
                ->with('success', 'Product updated successfully.');
                
        } catch (QueryException $e) {
            Log::error('Product update database error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Database error while updating product.');
                
        } catch (\Throwable $e) {
            Log::error('Product update unexpected error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Unexpected error occurred.');
        }
    }

    public function edit(Product $product)
    {
        // Proteksi Policy: Hanya pemilik yang boleh masuk ke halaman edit
        $this->authorize('update', $product);

        $users = User::orderBy('name')->get();

        return view('product.edit', compact('product', 'users'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // Proteksi Policy (Admin bisa hapus semua, User hanya miliknya)
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }
}