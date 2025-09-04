<?php

namespace Javarex\DdoLogin\Providers;

use Illuminate\Support\ServiceProvider;

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

    }
}
