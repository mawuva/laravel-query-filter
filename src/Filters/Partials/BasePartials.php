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

        $query ->{$this->determineMethod()}($property, 'LIKE', resolvePartialsValue($this ->value, $this ->pattern));

        return $query;
    }

    protected function determineMethod()
    {
        return ($this ->logicalOperator === LogicalOperator::AND) ? 'where' : 'orWhere';
    }
}