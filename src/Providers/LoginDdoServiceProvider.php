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

            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/ddo-login'),
            ], 'ddo-login-views');

            $this->publishes([
                __DIR__ . '/../Pages/Edit.php' => app_path('Filament/Pages/DdoLogin/EditAccount.php'),
            ], 'ddo-login-edit');

            $this->publishes([
                __DIR__ . '/../Pages/Login.php' => app_path('Filament/Pages/DdoLogin/Login.php'),
            ], 'ddo-login');
        }

        FilamentAsset::register([
            Css::make('ddo-login-styles', __DIR__ . '/../../resources/dist/plugin.css'),
        ], 'javarex/ddo-login');

    }
}
