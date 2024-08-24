<?php

namespace Mawuva\QueryFilter\Filters;

use Illuminate\Database\Eloquent\Builder;
use Mawuva\QueryFilter\Enums\LogicalOperator;

abstract class BaseFilter
{
    protected $query;

    protected $property;
    protected $value;
    protected $logicalOperator;

    public function __construct(string $property, $value, $logicalOperator = LogicalOperator::OR)
    {
        $this->property         = $property;
        $this->value            = $value;
        $this->logicalOperator  = $logicalOperator;
    }

    /**
     * @param $query
     * @param $nextFilter
     *
     * @return Builder
     */
    public function handle($query, $nextFilter)
    {
        $query = $nextFilter($query);

        return static::apply($query);
    }
}