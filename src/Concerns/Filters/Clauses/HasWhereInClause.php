<?php

namespace Mawuva\QueryFilter\Concerns\Filters\Clauses;

use Mawuva\QueryFilter\Enums\LogicalOperator;

trait HasWhereInClause
{
    protected function applyWhereInClause($query, $property, $value)
    {
        $query ->{$this->determineWhereInMethod()}($property, $value);
    }

    private function determineWhereInMethod()
    {
        return ($this ->logicalOperator === LogicalOperator::AND) ? 'whereIn' : 'orWhereIn';
    }
}