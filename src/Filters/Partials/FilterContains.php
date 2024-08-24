<?php

namespace Mawuva\QueryFilter\Filters\Partials;

use Mawuva\QueryFilter\Enums\PartialsPattern;

class FilterContains extends BasePartials
{
    protected $pattern = PartialsPattern::CONTAINS;
}