<?php

namespace Mawuva\QueryFilter\Concerns\Requests;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Mawuva\QueryFilter\Exceptions\InvalidFilterQuery;

trait RequestedFiltersManager
{
    /**
     * @var mixed
     */
    protected $requestedFilters;

    /**
     * Set requested filters
     *
     * @param mixed $filterParts
     * @return void
     */
    protected function setRequestedFilter(mixed $filterParts)
    {
        $this ->requestedFilters = [];

        foreach ($filterParts as $value) {
            if (Str::contains($value, '|')) {
                $data = explode('|', $value);

                if (!empty($data[1])) {
                    $this ->requestedFilters[] = $data[1];
                }
            }
        }
    }

    /**
     * Get requested filters
     *
     * @return array
     */
    public function getRequestedFilters(): array
    {
        return collect($this->requestedFilters)->unique()->values();
    }

    /**
     * @param $filter
     * @return bool
     */
    protected function isFilterRequested($filter): bool
    {
        return $this ->filters()->has($filter);
    }

    /**
     * @param mixed $filterParts
     * @return Collection
     */
    protected function resolveFilterParts(mixed $filterParts): Collection
    {
        $filterData = [];
        $specifiedFilterDelimiter = config('query-filter.specified_filter_delimiter', '|');

        foreach ($filterParts as $key => $value) {
            if (Str::contains($key, $specifiedFilterDelimiter)) {
                $filterDetails = explode($specifiedFilterDelimiter, $key);

                if (count($filterDetails) > 2) {
                    throw new InvalidFilterQuery(config('query-filter.messages.too_many_filters'));
                }

                if (!empty($filterDetails[1])) {
                    $filterData[$filterDetails[0]] = [
                        'filter'=>$filterDetails[1],
                        'values'=> $this ->getFilterValue($value)
                    ];

                    $this ->requestedFilters[] = $filterDetails[1];
                }

                else {
                    $filterData[$filterDetails[0]] = [
                        'values'=> $this ->getFilterValue($value)
                    ];
                }
            }

            else {
                $filterData[$key] = [
                    'value'=> $this ->getFilterValue($value)
                ];
            }
        }

        return collect($filterData);
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    protected function getFilterValue(mixed $value): mixed
    {
        $delimiter = config('query-filter.value_delimiter.filter', ",");

        if (empty($value)) {
            return $value;
        }

        if (is_array($value)) {
            return collect($value)->map(function ($valueValue) {
                return $this->getFilterValue($valueValue);
            })->all();
        }

        if (Str::contains($value, $delimiter)) {
            return explode($delimiter, $value);
        }

        if ($value === 'true') {
            return true;
        }

        if ($value === 'false') {
            return false;
        }

        return $value;
    }
}