<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        $env_test = config('app.tunnel_test');
        $env = config('app.env');

        if ($env == 'production' || $env_test == true) {
            URL::forceScheme('https');
        }
    }
}
