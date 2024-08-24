<?php

namespace Mawuva\QueryFilter\Concerns\Queries;

use Illuminate\Database\Eloquent\Builder;

trait FiltersQuery
{
    /**
     * @var
     */
    protected $availableFilters;

    /**
     * Filterable properties
     *
     * @return array
     */
    abstract protected function filterables(): array;

    /**
     * Apply filter query from query string.
     *
     * @return Builder
     */
    public function applyFilterQuery(): Builder
    {
        $filterRequest = $this ->request ->filters();

        if (is_null($filterRequest) || $filterRequest ->isEmpty()) {
            return $this ->builder;
        }

        return $this ->builder;
    }
}