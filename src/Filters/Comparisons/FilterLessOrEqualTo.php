<?php

namespace Mawuva\QueryFilter\Filters\Comparisons;

use Mawuva\QueryFilter\Enums\ComparisonOperator;

class FilterLessOrEqualTo extends BaseComparison
{
    protected $operator = ComparisonOperator::LESS_THAN_OR_EQUAL_TO;
}