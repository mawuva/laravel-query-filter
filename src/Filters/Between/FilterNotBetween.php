<?php

namespace Mawuva\QueryFilter\Filters\Between;

use Mawuva\QueryFilter\Concerns\Filters\Clauses\HasBetweensClause;
use Mawuva\QueryFilter\Enums\BetweenClause;
use Mawuva\QueryFilter\Filters\BaseFilter;

class FilterNotBetween extends BaseFilter
{
    use HasBetweensClause;

    protected $betweenMethod = BetweenClause::NOT_BETWEEN;
}