<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // You can register additional services here.
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Manually load API routes and apply the 'api' prefix and middleware.
        \Illuminate\Support\Facades\Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
    }      
}
