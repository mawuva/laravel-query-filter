<?php

namespace Mawuva\QueryFilter\Concerns\Filters\Clauses;

use Mawuva\QueryFilter\Enums\LogicalOperator;

trait HasWhereNotInClause
{
    protected function applyWhereNotInClause($query, $property, $value)
    {
        $query ->{$this->determineWhereNotInMethod()}($property, $value);
    }

    private function determineWhereNotInMethod()
    {
        return ($this ->logicalOperator === LogicalOperator::AND) ? 'whereNotIn' : 'orWhereNotIn';
    }
}