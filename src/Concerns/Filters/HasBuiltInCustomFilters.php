<?php

namespace Mawuva\QueryFilter\Concerns\Filters;

trait HasBuiltInCustomFilters
{
    /**
     * @var array
     */
    protected $customBuiltInFilters = [
        'trashed' => 'builtInFilterTrashed',
    ];

    /**
     * @param $filterName
     * @return bool
     */
    protected function isCustomBuiltInFilter($filterName): bool
    {
        return in_array($filterName, array_keys($this->customBuiltInFilters));
    }

    /**
     * @param $filterName
     * @return string|null
     */
    protected function getCustomBuiltInFilter($filterName): ?string
    {
        return $this->customBuiltInFilters[$filterName] ?? null;
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    protected function builtInFilterTrashed($query, $value)
    {
        if ($value === 'only') {
            return $query->onlyTrashed();
        }

        if ($value === 'with') {
            return $query->withTrashed();
        }

        return $query->withoutTrashed();
    }
}