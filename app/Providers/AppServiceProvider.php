<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /**
         * Gate: export-product
         */
        Gate::define('export-product', function (User $user) {
            return $user->role === 'admin';
        });

        /**
         * Gate: manage-category (Tambahan Baru)
         * Mengizinkan akses menu Category hanya untuk Admin
         */
        Gate::define('manage-category', function (User $user) {
            return $user->role === 'admin';
        });
    }
}