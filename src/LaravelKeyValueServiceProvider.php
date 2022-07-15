<?php

namespace Samaphp\LaravelKeyValue;

use Illuminate\Support\ServiceProvider;

class LaravelKeyValueServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Samaphp\LaravelKeyValue\LaravelKeyValue');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('/migrations/'),
        ], 'migrations');
    }
}
