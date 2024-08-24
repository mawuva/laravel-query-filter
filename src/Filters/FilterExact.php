<?php

namespace Mawuva\QueryFilter\Filters;

use Illuminate\Database\Eloquent\Builder;
use Mawuva\QueryFilter\Concerns\Filters\Clauses\HasWhereClause;
use Mawuva\QueryFilter\Concerns\Filters\Clauses\HasWhereInClause;
use Mawuva\QueryFilter\Enums\ComparisonOperator;

class FilterExact extends BaseFilter
{
    use HasWhereClause, HasWhereInClause;

    /**
     * Apply filter
     *
     * @param $query
     * @return Builder
     */
    protected function apply($query): Builder
    {
        $property   = $query->qualifyColumn($this->property);
        $value      = $this->value;

        if (is_array($value)) {
            $this ->applyWhereInClause($query, $property, $value);
        }

        else {
            $this ->applyWhereClause($query, $property, $value, ComparisonOperator::EQUAL_TO);
        }

        return $query;
    }
}