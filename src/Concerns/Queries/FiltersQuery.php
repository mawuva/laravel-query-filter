<?php

namespace Mawuva\QueryFilter\Concerns\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Collection;
use Mawuva\QueryFilter\Classes\AvailableFilter;
use Mawuva\QueryFilter\Concerns\Filters\HasBuiltInCustomFilters;
use Mawuva\QueryFilter\Concerns\Filters\Resolvings;
use Mawuva\QueryFilter\Exceptions\InvalidFilterQuery;

trait FiltersQuery
{
    use HasBuiltInCustomFilters, Resolvings;

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

        $this ->availableFilters = $this->resolveAvailableFilters();

        $this ->ensureAllPropertiesAreFilterable();
        $this ->ensureAllFiltersExist();

        $filters = $this->request->filters() ->map(function ($filter, $property) {
            $availableFilter = $this ->availableFilters->first(function (AvailableFilter $availableFilter) use ($property)  {
                return $availableFilter->getName() === $property;
            });

            return $this ->resolve($availableFilter, $filter);
        })->toArray();

        $this ->addFiltersToQuery($filters);

        return $this ->builder;
    }

    /**
     * @param $filters
     * @return void
     */
    public function addFiltersToQuery($filters): void
    {
        app(Pipeline::class)
            ->send($this->builder)
            ->through($filters)
            ->thenReturn();
    }

    /**
     * @return Collection
     */
    protected function resolveAvailableFilters(): Collection
    {
        return collect(array_merge($this->filterables(), array_keys($this->customBuiltInFilters))) ->map(function ($filter) {
            if ($filter instanceof AvailableFilter) {
                return $filter;
            }

            return AvailableFilter::make($filter);
        });
    }

    /**
     * @return void
     */
    protected function ensureAllFiltersExist(): void
    {
        $availableBuiltInFilterNames = AvailableFilter::collectBuiltInFiltersKeys();

        $diff = $this->request->getRequestedFilters()->diff($availableBuiltInFilterNames);

        if ($diff->isNotEmpty()) {
            InvalidFilterQuery::unavailableFilters($diff, $availableBuiltInFilterNames);
        }
    }

    /**
     * @return void
     */
    protected function ensureAllPropertiesAreFilterable(): void
    {
        $filterNames = $this->request->filters()->keys();

        $availableFilterNames = $this ->availableFilters->map(function (AvailableFilter $availableFilter) {
            return $availableFilter->getName();
        });

        $diff = $filterNames ->diff($availableFilterNames);

        if ($diff->isNotEmpty()) {
            InvalidFilterQuery::infiltrableProperties($diff, $availableFilterNames);
        }
    }
}