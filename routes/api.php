<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Route bawaan untuk mendapatkan data user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- 1. ROUTE PUBLIC (Tanpa Login) ---

// Auth: Login untuk mendapatkan access_token
Route::post('/login', [AuthController::class, 'getToken']);

// Product: Melihat data (Sesuai Modul)
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);


// --- 2. ROUTE PRIVATE (Wajib Token Sanctum) ---

Route::middleware('auth:sanctum')->group(function () {
    
    /**
     * API Product (Store, Update, Delete)
     * Rute ini diproteksi karena mengubah data database
     */
    Route::post('/product', [ProductController::class, 'store']);
    Route::put('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);

    /**
     * API Category (Tugas Praktikum)
     * Menggunakan apiResource untuk otomatis mencakup:
     * GET /category (index)
     * POST /category (store)
     * GET /category/{id} (show)
     * PUT /category/{id} (update)
     * DELETE /category/{id} (destroy)
     */
    Route::apiResource('category', CategoryController::class);
});