<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Menggunakan view composer untuk membagikan data ke semua views
        view()->composer('*', function ($view) {
            // Logic untuk mendapatkan jumlah item di cart
            $cartCount = Cart::where('user_id', auth()->id())->count();

            // Mengirimkan data ke view dengan nama 'cartCount'
            $view->with('cartCount', $cartCount);
        });
    }
}
