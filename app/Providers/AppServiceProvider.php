<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        \Blade::if('verified', function () {
            return auth()->user()->verified;
        });

        \Blade::if('admin', function () {
            return auth()->user()->hasRole('admin');
        });

        \Blade::if('query', function ($param) {
            return ! is_null($param) and '' != $param;
        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        if ('production' !== $this->app->environment()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
