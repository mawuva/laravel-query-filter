<?php

namespace Mawuva\QueryFilter\Concerns\Filters;

use Closure;
use Mawuva\QueryFilter\Classes\AvailableFilter;

trait Resolvings
{
    private function resolve(AvailableFilter $property, $propertyFilters)
    {
        if($this->isCustomFilter($property ->getName())) {
            return $this->resolveCustomFilter($property ->getName(), $propertyFilters['value']);
        }

        if($this ->isCustomBuiltInFilter($property ->getName())) {
            return $this->resolveCustomFilter($this ->getCustomBuiltInFilter($property ->getName()), $propertyFilters['value']);
        }

        if ($this ->filterIsSpecified($propertyFilters)) {
            return AvailableFilter::applyFilter($propertyFilters['filter'], $property ->getInsideName(), $propertyFilters['value'], $property ->getName());
        }

        return AvailableFilter::applyDefaultFilter($property ->getInsideName(), $propertyFilters['value'], $property ->getName());
    }

    private function resolveCustomFilter($filterName, $values)
    {
        return $this->getClosure($this->makeCallable($filterName), $values);
    }

    /**
     * @param $filter
     * @return string
     */
    private function makeCallable($filter)
    {
        return static::class.'@'.$filter;
    }

    /**
     * @param $filterName
     * @return bool
     */
    private function isCustomFilter($filterName)
    {
        return method_exists($this, $filterName);
    }

    /**
     * @param $callable
     * @param $values
     *
     * @return Closure
     */
    private function getClosure($callable, $values)
    {
        return function ($query, $nextFilter) use ($callable, $values) {
            return app()->call($callable, ['query' => $nextFilter($query), 'value' => $values]);
        };
    }

    /**
     * @param array $filterData
     * @return bool
     */
    private function filterIsSpecified(array $filterData): bool
    {
        return array_key_exists('filter', $filterData);
    }
}