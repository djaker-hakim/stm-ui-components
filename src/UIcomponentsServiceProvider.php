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
        $this->loadViewsFrom(__DIR__.'/views', 'stm');
        Blade::componentNamespace('stm\\UIcomponents', 'stm');
        $this->publishes([
            __DIR__.'/views/components' => resource_path('views/components/'),
        ]);
    }
}