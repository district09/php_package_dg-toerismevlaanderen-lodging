<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Request;

use DigipolisGent\Toerismevlaanderen\Lodging\Filter\FilterInterface;

/**
 * Request based on provided filters.
 */
abstract class AbstractFilteredRequest extends AbstractRequest
{
    /**
     * Create a new request from query string and provided filters.
     *
     * @param string $query
     *   The query string with placeholders for where & filter.
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Filter\FilterInterface ...$filters
     *   The filters to apply.
     */
    public function __construct(string $query, FilterInterface ...$filters)
    {
        $whereParts = [];
        $filterParts = [];
        foreach ($filters as $filter) {
            $whereParts[] = $filter->where();
            $filterParts[] = $filter->filter();
        }

        $query = sprintf(
            $query,
            implode(PHP_EOL, $whereParts),
            implode(PHP_EOL, $filterParts)
        );

        parent::__construct($query);
    }
}
