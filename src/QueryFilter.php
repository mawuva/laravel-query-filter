<?php

namespace Mawuva\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Mawuva\QueryFilter\Concerns\Queries\{FieldsQuery, FiltersQuery, SearchQuery, SortsQuery};

abstract class QueryFilter
{
    use FiltersQuery, SearchQuery, FieldsQuery, SortsQuery;

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
        $this ->applyFieldQuery();
        $this ->applySortQuery();

        return $this ->builder;
    }

    public function requestedFilter($filter)
    {
        return $this ->request->filters()->has($filter);
    }
}
