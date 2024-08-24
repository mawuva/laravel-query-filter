<?php

namespace Mawuva\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Mawuva\QueryFilter\Concerns\Queries\{FiltersQuery, SearchQuery};

abstract class QueryFilter
{
    use FiltersQuery, SearchQuery;

    /**
     * @var RequestQueryBuilder
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    public function __construct(?Request $request = null)
    {
        $this ->request = $request
            ? RequestQueryBuilder::fromRequest($request)
            : app(RequestQueryBuilder::class);
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

        $this ->applySearchQuery();
        $this ->applyFilterQuery();

        return $this ->builder;
    }
}
