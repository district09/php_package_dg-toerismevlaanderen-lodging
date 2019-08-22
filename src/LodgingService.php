<?php

namespace DigipolisGent\Toerismevlaanderen\Lodging;

use DigipolisGent\API\Client\ClientInterface;
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
     * @param string $locality
     *   The locality name.
     * @param string[] $registrationStatus
     *   Array of registration statuses.
     *
     * @return int
     *   The number of lodges that apply to the given filter.
     */
    public function count(string $locality, $registrationStatus): int
    {
        $request = new CountRequest($locality, $registrationStatus);
        return $this->client->send($request)->count();
    }
}
