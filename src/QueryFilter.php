<?php

namespace Mawuva\QueryFilter;

use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter
{
    /**
     * @var Builder
     */
    protected $builder;

    public function __construct()
    {
    }

    /**
     * Apply the filters to the query.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this ->builder = $builder;

        return $this ->builder;
    }
}
