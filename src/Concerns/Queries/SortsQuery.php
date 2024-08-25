<?php

namespace Mawuva\QueryFilter\Concerns\Queries;

use Illuminate\Database\Eloquent\Builder;

trait SortsQuery
{
    protected $availableSorts;

    /**
     * List of default sorts
     *
     * @var array
     */
    abstract protected function defaultSorts(): array;

    /**
     * List of sortables properties
     *
     * @var array
     */
    abstract protected function sortables(): array;

    /**
     * Perform a search from query string.
     *
     * @return Builder
     */
    public function applySortQuery(): Builder
    {
        $this ->builder ->orderBy('created_at', 'desc');

        return $this ->builder;
    }
}