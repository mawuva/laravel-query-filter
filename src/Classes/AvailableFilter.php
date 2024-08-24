<?php

namespace Mawuva\QueryFilter\Classes;

use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Mawuva\QueryFilter\Concerns\Classes\AvailabilityHelper;
use Mawuva\QueryFilter\Filters\Partials\FilterContains;

class AvailableFilter
{
    use AvailabilityHelper;

    /**
     * @var array
     */
    protected static $availableBuiltInFilters = [
        'default' => FilterContains::class
    ];

    public function __construct(protected string $name, ?string $insideName = null)
    {
        $this->insideName = $insideName ?? $name;
    }

    /**
     * @param string $filterName
     * @param string $property
     * @param mixed $values
     * @return Application|mixed
     */
    public static function applyFilter(string $filterName, string $property, mixed $value)
    {
        return app(static::getBuiltInFilter($filterName), ["property" =>$property, "value" =>$value]);
    }

    /**
     * @param string $property
     * @param mixed $values
     * @return Application|mixed
     */
    public static function applyDefaultFilter(string $property, mixed $value)
    {
        return static::applyFilter('default', $property, $value);
    }

    /**
     * @param $filterName
     * @return mixed
     */
    public static function getBuiltInFilter($filterName)
    {
        return static::$availableBuiltInFilters[$filterName];
    }

    /**
     * @return array
     */
    public static function getBuiltInFilters(): array
    {
        return static::$availableBuiltInFilters;
    }

    /**
     * @return Collection
     */
    public static function collectBuiltInFilters(): Collection
    {
        return collect(static::$availableBuiltInFilters);
    }

    /**
     * @return Collection
     */
    public static function collectBuiltInFiltersKeys(): Collection
    {
        return static::collectBuiltInFilters() ->keys();
    }
}