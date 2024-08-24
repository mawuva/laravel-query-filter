<?php

namespace Mawuva\QueryFilter\Filters\Comparisons;

use Illuminate\Database\Eloquent\Builder;
use Mawuva\QueryFilter\Concerns\Filters\Clauses\HasWhereClause;
use Mawuva\QueryFilter\Filters\BaseFilter;

class BaseComparison extends BaseFilter
{
    use HasWhereClause;

    protected $operator;

    /**
     * Apply filter
     *
     * @param $query
     * @return Builder
     */
    protected function apply($query): Builder
    {
        $property   = $query->qualifyColumn($this ->property);
        $value      = $this->value;

        if (is_array($value)) {
            foreach (filterValue($value) as $item) {
                $this ->applyWhereClause($query, $property, $item, $this->operator);
            }
        }

        else {
            $this ->applyWhereClause($query, $property, $value, $this->operator);
        }

        return $query;
    }
}