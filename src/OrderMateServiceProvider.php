<?php

namespace CyberCraft\OrderMate;

use Illuminate\Support\ServiceProvider;

class OrderMateServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'ordermate');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'ordermate');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

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
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ordermate.php', 'ordermate');

        // Register the service the package provides.
        $this->app->singleton('ordermate', function ($app) {
            return new OrderMate;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ordermate'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/ordermate.php' => config_path('ordermate.php'),
        ], 'ordermate.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/cybercraft'),
        ], 'ordermate.views');*/

        // Publishing assets.
        $this->publishes([
            __DIR__.'/resources/assets' => public_path('vendor/cybercraft/ordermate'),
        ], 'ordermate.views');

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/cybercraft'),
        ], 'ordermate.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
