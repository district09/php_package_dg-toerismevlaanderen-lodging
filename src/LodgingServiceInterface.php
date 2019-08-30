<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging;

use DigipolisGent\Toerismevlaanderen\Lodging\Filter\FilterInterface;

/**
 * Service to access the Toerismevlaanderen Lodging open data.
 */
interface LodgingServiceInterface
{
    /**
     * Count the number of lodges by the given filter.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Filter\FilterInterface ...$filters
     *   Filters to count the lodges by.
     *
     * @return int
     *   The number of lodgings that apply to the given filters.
     */
    public function count(FilterInterface ...$filters): int;

    /**
     * Get a list of lodgings by the given filters.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Filter\FilterInterface ...$filters
     *   Filters to count the lodges by.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem[]
     *   Array of lodgings.
     */
    public function list(FilterInterface ...$filters): array;
}
