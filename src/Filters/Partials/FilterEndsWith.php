<?php

namespace Mawuva\QueryFilter\Filters\Partials;

use Mawuva\QueryFilter\Enums\PartialsPattern;

class FilterEndsWith extends BasePartials
{
    protected $pattern = PartialsPattern::ENDS_WITH;
}