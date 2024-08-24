<?php

namespace Mawuva\QueryFilter;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mawuva\QueryFilter\Skeleton\SkeletonClass
 */
class QueryFilterFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'query-filter';
    }
}
