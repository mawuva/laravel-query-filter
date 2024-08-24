<?php

namespace Mawuva\QueryFilter\Filters\Partials;

use Mawuva\QueryFilter\Enums\PartialsPattern;

class FilterStartsWith extends BasePartials
{
    protected $pattern = PartialsPattern::STARTS_WITH;
}