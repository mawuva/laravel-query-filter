<?php

namespace Mawuva\QueryFilter\Concerns\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Mawuva\QueryFilter\Classes\AvailableFilter;

trait SearchQuery
{
    protected $availableProperties;

    /**
     * Searchable columns
     *
     * @return array
     */
    abstract protected function searchableProperties(): array;

    /**
     * Perform a search from query string.
     *
     * @return Builder
     */
    public function applySearchQuery(): Builder
    {
        $textForSearching = $this ->request ->search();

        $this ->availableProperties = $this ->resolveSearchableColumns();

        if (is_null($textForSearching) || empty($this ->searchableProperties())) {
            return $this ->builder;
        }

        $filters = $this ->availableProperties ->map(function ($filter) use ($textForSearching) {
            return $this ->resolve(
                $filter, [
                    'filter'    => 'contains',
                    'value'     => $textForSearching->toArray()
                ]
            );
        }) ->toArray();

        addFiltersToQuery($this ->builder, $filters);

        return $this ->builder;
    }

    /**
     * @return Collection
     */
    protected function resolveSearchableColumns()
    {
        return collect(array_merge($this->searchableProperties())) ->map(function ($property) {
            if ($property instanceof AvailableFilter) {
                return $property;
            }

            return AvailableFilter::make($property);
        });
    }
}