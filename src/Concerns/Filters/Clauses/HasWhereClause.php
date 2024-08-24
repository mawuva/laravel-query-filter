<?php

namespace Mawuva\QueryFilter\Concerns\Filters\Clauses;

use Mawuva\QueryFilter\Enums\LogicalOperator;

trait HasWhereClause
{
    protected function applyWhereClause($query, $property, $value, $operator = null)
    {
        $this ->{$this->determineWhereMethod()}($query, $property, $value, $operator);
    }

    private function orWhere($query, $property, $value, $operator = null)
    {
        (!is_null($operator))
            ? $query ->orWhere($property, $operator, $value)
            : $query ->orWhere($property, $value);
    }

    private function andWhere($query, $property, $value, $operator = null)
    {
        (!is_null($operator))
            ? $query ->where($property, $operator, $value)
            : $query ->where($property, $value);
    }

    private function determineWhereMethod()
    {
        return ($this ->logicalOperator === LogicalOperator::AND) ? 'andWhere' : 'orWhere';
    }
}