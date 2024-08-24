<?php

namespace Mawuva\QueryFilter;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Mawuva\QueryFilter\Concerns\Requests\RequestedFiltersManager;

class RequestQueryBuilder extends Request
{
    use RequestedFiltersManager;

    /**
     * Instantiate from request
     *
     * @param Request $request
     * @return self
     */
    public static function fromRequest(Request $request): self
    {
        return static::createFrom($request, new static());
    }

    /**
     * Get request data
     *
     * @param string|null $key
     * @param $default
     *
     * @return mixed
     */
    protected function getRequestData(?string $key = null, $default = null)
    {
        return $this->input($key, $default);
    }

    /**
     * @return Collection|null
     */
    public function filters(): ?Collection
    {
        $filterParameterName = config('query-filter.parameters.filter', 'filter');

        if (!$this ->has($filterParameterName)) {
            return null;
        }

        $filterParts = $this ->getRequestData($filterParameterName);

        if (is_null($filterParts) || is_string($filterParts)) {
            return collect();
        }

        $this ->setRequestedFilter(array_keys($filterParts));

        return $this->resolveFilterParts($filterParts);
    }
}