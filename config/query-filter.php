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
];