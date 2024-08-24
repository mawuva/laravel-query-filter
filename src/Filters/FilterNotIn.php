<?php

namespace Mawuva\QueryFilter\Filters;

use Illuminate\Database\Eloquent\Builder;
use Mawuva\QueryFilter\Concerns\Filters\Clauses\HasWhereNotInClause;

class FilterNotIn extends BaseFilter
{
    use HasWhereNotInClause;

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

        $this ->applyWhereNotInClause($query, $property, $value);

        return $query;
    }
}