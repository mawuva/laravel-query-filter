<?php

namespace Mawuva\QueryFilter\Filters\Comparisons;

use Mawuva\QueryFilter\Enums\ComparisonOperator;

class FilterGreaterOrEqualTo extends BaseComparison
{
    protected $operator = ComparisonOperator::GREATER_OR_EQUAL_TO;
}