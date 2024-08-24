<?php

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Str;

if (! function_exists('filterValue')) {
    function filterValue($value) {
        return array_filter($value, fn ($item) => strlen($item) > 0);
    }
}

if (! function_exists('countOfFilterValue')) {
    function countOfFilterValue($value) {
        return count(filterValue($value));
    }
}

if (! function_exists('resolvePartialsValue')) {
    function resolvePartialsValue($value, $pattern) {
        return Str::replace('value', $value, $pattern);
    }
}

if (! function_exists('addFiltersToQuery')) {
    function addFiltersToQuery($query, $filters) {
        app(Pipeline::class)
            ->send($query)
            ->through($filters)
            ->thenReturn();
    }
}
