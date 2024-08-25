<?php

return [
    // The method to call on your model to use the query filter.
    'method' => [
        'filter' => 'filter',
        'get_filtered' => 'getFiltered',
        'get_paginated_filtered' => 'getPaginatedFiltered',
    ],

    // The namespace to use for query filter classes.
    'filter_namespace' => 'App\Filters',

    /**
     * These are the value delimiter for the query parameters.
     *
     * You can customize these query string parameters here.
     */
    'value_delimiter' => [
        'search' => ",",
        'filter' => ",",
    ],

    'specified_filter_delimiter' => '|',

    /**
     * These are the value for pagination.
     *
     * You can customize parameters here.
     */
    'paginate' => [
        'per_page' => "20",
    ],

    /*
     * By default the package will use the `search`, `include`, `filter`, `sort` and `fields` query parameters.
     *
     * You can customize these query string parameters here.
     */
    'parameters' => [
        'search'    => 'search',
        'include'   => 'include',
        'filter'    => 'filter',
        'sort'      => 'sort',
        'fields'    => 'sort'
    ],

    'messages' => [
        'too_many_filters'              => 'Too many filters in the query string. Only one pipe character is allowed.',
        'invalid_filter_query'          => 'Invalid filter query. Please check your query parameters.',
        'infiltrable_attributes'        => 'Requested property(ies) :invalid are not filterables. Filterables property(ies) are :available.',
        'invalid_filter'                => 'Requested filter(s) :invalid are not available. Available filters are :available.',
        'between_value_should_be_two'   => 'The maximum number of value for between filter should be 2.',

        'invalid_search_query'          => 'Invalid search query. Please check your query parameters.',
        'invalid_include_query'         => 'Invalid include query. Please check your query parameters.',
        'invalid_sort_query'            => 'Invalid sort query. Please check your query parameters.',
        'invalid_fields_query'          => 'Invalid fields query. Please check your query parameters.',
    ],
];