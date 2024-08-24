<?php

namespace Mawuva\QueryFilter;

use Illuminate\Support\ServiceProvider;

class QueryFilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/query-filter.php' => config_path('query-filter.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/query-filter.php', 'query-filter');

        // Register the main class to use with the facade
        $this->app->singleton('query-filter', function () {
            return new QueryFilter;
        });
    }
}
