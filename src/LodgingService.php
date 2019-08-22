<?php

namespace DigipolisGent\Toerismevlaanderen\Lodging;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Filter\FilterInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\CountRequest;

/**
 * Service to access the Toerismevlaanderen Lodging linked open data.
 */
class LodgingService
{

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * Create a new lodging service by injecting the Sparql client.
     *
     * @param \DigipolisGent\API\Client\ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Count the number of lodges by the given filter.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Filter\FilterInterface ...$filters
     *   Filters to count the lodges by.
     *
     * @return int
     *   The number of lodges that apply to the given filter.
     */
    public function count(FilterInterface ...$filters): int
    {
        $request = new CountRequest(...$filters);
        return $this->client->send($request)->count();
    }
}
