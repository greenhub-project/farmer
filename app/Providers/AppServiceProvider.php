<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\RedirectIfInsecure;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if (app()->environment() === 'production') {
            $kernel->prependMiddleware(RedirectIfInsecure::class);
        }

        Blade::if('admin', function () {
            return Auth::user()->hasRole('admin');
        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}
