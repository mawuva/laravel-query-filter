<?php

namespace Mawuva\QueryFilter\Concerns\Filters;

trait HasBuiltInCustomFilters
{
    /**
     * @var array
     */
    protected $customBuiltInFilters = [];

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
}