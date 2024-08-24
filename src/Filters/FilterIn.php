<?php

namespace Mawuva\QueryFilter\Filters;

use Illuminate\Database\Eloquent\Builder;
use Mawuva\QueryFilter\Concerns\Filters\Clauses\HasWhereInClause;

class FilterIn extends BaseFilter
{
    use HasWhereInClause;

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

        $this ->applyWhereInClause($query, $property, $value);

        return $query;
    }
}