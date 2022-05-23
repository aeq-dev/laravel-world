<?php

namespace Bkfdev\World;

use Illuminate\Support\ServiceProvider;

class LaravelWorldServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'bkfdev');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'bkfdev');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        //$this->loadRoutesFrom(__DIR__ . '/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-world.php', 'laravel-world');

        // Register the service the package provides.
        $this->app->singleton('laravel-world', function ($app) {
            return new World;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-world'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/laravel-world.php' => config_path('laravel-world.php'),
        ], 'laravel-world.config');

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([__DIR__ . '/../database/seeders/' => base_path('database/seeders')], 'seeders');

        // Registering package commands.
        $this->commands([
            \Bkfdev\World\Console\InitCommand::class,
        ]);
    }
}
