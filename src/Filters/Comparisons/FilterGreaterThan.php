<?php

namespace Mawuva\QueryFilter\Filters\Comparisons;

use Mawuva\QueryFilter\Enums\ComparisonOperator;

class FilterGreaterThan extends BaseComparison
{
    protected $operator = ComparisonOperator::GREATER_THAN;
}