<?php

namespace Mawuva\QueryFilter\Filters\Comparisons;

use Mawuva\QueryFilter\Enums\ComparisonOperator;

class FilterEqual extends BaseComparison
{
    protected $operator = ComparisonOperator::EQUAL_TO;
}