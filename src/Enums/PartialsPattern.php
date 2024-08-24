<?php

namespace Mawuva\QueryFilter\Enums;

class PartialsPattern
{
    public const CONTAINS = '%value%';
    public const STARTS_WITH = 'value%';
    public const ENDS_WITH = '%value';
}