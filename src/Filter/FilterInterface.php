<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Filter;

/**
 * Filter for a Sparql Query.
 */
interface FilterInterface
{
    /**
     * Get the where part of the filter.
     *
     * @return string
     */
    public function where(): string;

    /**
     * Get the filter part of the filter.
     *
     * @return string
     */
    public function filter(): string;
}
