<?php

namespace Mawuva\QueryFilter\Concerns\Classes;

trait AvailabilityHelper
{
    /**
     * Inside name
     *
     * @var string
     */
    protected string $insideName;

    /**
     * @param string $name
     * @return static
     */
    public static function make(string $name)
    {
        return new static($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getInsideName(): string
    {
        return $this->insideName;
    }
}