<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Menambahkan kolom category_id setelah user_id
            // nullable() digunakan agar data produk lama tidak error saat migration dijalankan
            $table->foreignId('category_id')
                  ->nullable()
                  ->after('user_id')
                  ->constrained('kategoris') 
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Menghapus constraint dan kolom jika migration di-rollback
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};