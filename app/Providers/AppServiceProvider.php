<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Import Gate Facade (Penting!)
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Implementasi Gate: export-product (Tugas Kelas B)
         * Mengizinkan akses jika user memiliki role 'admin'
         */
        Gate::define('export-product', function (User $user) {
            return $user->role === 'admin';
        });
    }
}