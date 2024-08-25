<?php

namespace Mawuva\QueryFilter\Exceptions;

class InvalidFilterValue extends InvalidQuery
{
    public function __construct(string $message = 'Invalid filter query')
    {
        parent::__construct(Response::HTTP_BAD_REQUEST, $message);
    }

    public static function invalidFilterBetweenValue(): static
    {
        return throw new static(config('query-filter.messages.between_value_should_be_two'));
    }
}