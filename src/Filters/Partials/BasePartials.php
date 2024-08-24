<?php

namespace Mawuva\QueryFilter\Filters\Partials;

use Illuminate\Database\Eloquent\Builder;
use Mawuva\QueryFilter\Enums\LogicalOperator;
use Mawuva\QueryFilter\Filters\BaseFilter;

class BasePartials extends BaseFilter
{
    /**
     * @var string
     */
    protected $pattern; // = '%value%';

    /**
     * Apply filter
     *
     * @param $query
     * @return Builder
     */
    protected function apply($query): Builder
    {
        $property = $query->qualifyColumn($this ->property);
        $value = $this->value;

        if (is_array($value)) {
            if (countOfFilterValue($value) === 0) {
                return $query;
            }

            foreach (filterValue($value) as $item) {
                $query ->{$this->determineMethod()}($property, 'LIKE', resolvePartialsValue($item, $this ->pattern));
            }
        }

        if (is_string($value)) {
            $query ->{$this->determineMethod()}($property, 'LIKE', resolvePartialsValue($value, $this ->pattern));
        }

        return $query;
    }

    protected function determineMethod()
    {
        return ($this ->logicalOperator === LogicalOperator::AND) ? 'where' : 'orWhere';
    }
}