<?php

namespace Mawuva\QueryFilter\Classes;

use Mawuva\QueryFilter\Concerns\Classes\AvailabilityHelper;

class AvailableField
{
    use AvailabilityHelper;

    public function __construct(protected string $name, ?string $insideName = null)
    {
        $this->insideName = $insideName ?? $name;
    }
}