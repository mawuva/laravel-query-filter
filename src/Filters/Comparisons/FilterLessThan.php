<?php

namespace Mawuva\QueryFilter\Filters\Comparisons;

use Mawuva\QueryFilter\Enums\ComparisonOperator;

class FilterLessThan extends BaseComparison
{
    protected $operator = ComparisonOperator::LESS_THAN;
}