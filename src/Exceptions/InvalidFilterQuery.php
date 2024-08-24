<?php

namespace Mawuva\QueryFilter\Exceptions;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class InvalidFilterQuery extends InvalidQuery
{
    public function __construct(string $message = 'Invalid filter query')
    {
        parent::__construct(Response::HTTP_BAD_REQUEST, $message);
    }

    public static function infiltrableProperties(Collection $invalidFilters, Collection $availableFilters): InvalidFilterQuery
    {
        $message = "Requested attribute(s) `{$invalidFilters->implode(', ')}` are not filterable. Filterable attribute(s) are `{$availableFilters->implode(', ')}`.";

        return throw new static($message);
    }

    public static function unavailableFilters(Collection $invalidFilters, Collection $availableFilters): InvalidFilterQuery
    {
        $message = "Requested filter(s) `{$invalidFilters->implode(', ')}` are not available. Available filter(s) are `{$availableFilters->implode(', ')}`.";

        return throw new static($message);
    }
}