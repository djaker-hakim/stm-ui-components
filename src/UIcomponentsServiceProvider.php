<?php

namespace stm\UIcomponents;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class UIcomponentsServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom([
            __DIR__.'/views', 
            __DIR__.'/views/forms',
            __DIR__.'/views/ui',
            __DIR__.'/views/master',
        ], 'stm');
    }
}