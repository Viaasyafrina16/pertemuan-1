<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Kategori; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        // PERBAIKAN: Gunakan eager loading 'with' agar relasi kategori terbaca di view
        $products = Product::with(['category', 'user'])->get();
        return view('product.index', compact('products'));
    }

    public function export()
    {
        if (!Gate::allows('export-product')) {
            abort(403, 'Hanya Admin yang dapat melakukan export data.');
        }

        return redirect()->route('product.index')->with('success', 'Data berhasil di-export (Simulasi)');
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        // PERBAIKAN: Pastikan 'category_id' ada di dalam array validated 
        // (Pastikan di StoreProductRequest kolom 'category_id' sudah di-validate)

        try {
            Product::create($validated);
            return redirect()->route('product.index')->with('success', 'Product created successfully.');
                
        } catch (QueryException $e) {
            Log::error('Product store database error', ['message' => $e->getMessage()]);
            return redirect()->back()->withInput()->with('error', 'Database error while creating product.');
                
        } catch (\Throwable $e) {
            Log::error('Product store unexpected error', ['message' => $e->getMessage()]);
            return redirect()->back()->withInput()->with('error', 'Unexpected error occurred.');
        }
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $categories = Kategori::orderBy('name')->get(); 

        return view('product.create', compact('users', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with(['category', 'user'])->findOrFail($id);
        return view('product.view', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);
        $validated = $request->validated();

        try {
            $product->update($validated);
            return redirect()->route('product.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error updating product.');
        }
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $users = User::orderBy('name')->get();
        $categories = Kategori::orderBy('name')->get(); 

        return view('product.edit', compact('product', 'users', 'categories'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }
}