<?php

namespace Mawuva\QueryFilter\Concerns\Filters\Clauses;

use Illuminate\Database\Eloquent\Builder;
use Mawuva\QueryFilter\Exceptions\InvalidFilterValue;

trait HasBetweensClause
{
    protected $betweenMethod;

    /**
     * Apply filter
     *
     * @param $query
     * @return Builder
     */
    protected function apply($query): Builder
    {
        $property   = $query->qualifyColumn($this->property);

        if (is_array($this->value)) {
            if (count($this->value) != 2) {
                InvalidFilterValue::invalidFilterBetweenValue();
            }

            $value = $this->value;
        }

        else {
            $value = [$this->value, $this->value];
        }

        $query ->{$this->betweenMethod}($property, $value);

        return $query;
    }
}