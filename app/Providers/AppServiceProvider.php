<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
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
