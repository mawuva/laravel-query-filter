<?php

namespace Mawuva\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use Mawuva\QueryFilter\Commands\QueryFilterMakeCommand;

class QueryFilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        require_once __DIR__.'/helpers.php';
        
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/query-filter.php' => config_path('query-filter.php'),
            ], 'config');

            // Registering package commands.
            $this->commands([
                QueryFilterMakeCommand::class
            ]);
        }

        $this->bootEloquentFilterMacro();
        $this->bootEloquentGetFilteredMacro();
        $this->bootEloquentGetPaginatedFilteredMacro();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/query-filter.php', 'query-filter');
    }

    /**
     * Boot the eloquent builder 'filter' macro.
     *
     * @return mixed
     */
    protected function bootEloquentFilterMacro()
    {
        $method = config('query-filter.method.filter', 'filter');

        Builder::macro($method, function (?QueryFilter $filter = null) {
            if ($filter == null) {
                return $this;
            }

            return $filter ->apply($this);
        });
    }

    /**
     * Boot the eloquent builder 'getFiltered' macro.
     *
     * @return mixed
     */
    protected function bootEloquentGetFilteredMacro()
    {
        $method = config('query-filter.method.get_filtered', 'getFiltered');

        Builder::macro($method, function (?QueryFilter $filter = null) {
            if ($filter == null) {
                return $this;
            }

            return $filter ->apply($this) ->get();
        });
    }

    /**
     * Boot the eloquent builder 'getPaginatedFiltered' macro.
     *
     * @return mixed
     */
    protected function bootEloquentGetPaginatedFilteredMacro()
    {
        $method = config('query-filter.method.get_paginated_filtered', 'getPaginatedFiltered');
        $perPage = config('query-filter.paginate.per_page', '20');

        Builder::macro($method, function (?QueryFilter $filter = null) use($perPage) {
            if ($filter == null) {
                return $this;
            }

            return $filter ->apply($this) ->paginate($perPage);
        });
    }
}
