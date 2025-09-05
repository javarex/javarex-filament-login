<?php

namespace Javarex\DdoLogin\Providers;

use Filament\Support\Assets\Css;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;

class LoginDdoServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        // Merge config so it's available even without publishing
        $this->mergeConfigFrom(__DIR__ . '/../../config/ddo-login.php', 'ddo-login');
    }


    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'ddo-login');
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/ddo-login.php' => config_path('ddo-login.php'),
            ], 'ddo-login-config');
        }
        FilamentAsset::register([
            Css::make('ddo-login-styles', __DIR__ . '/../../resources/dist/plugin.css'),
        ], 'javarex/ddo-login');

    }
}
