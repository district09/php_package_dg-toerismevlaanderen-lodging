<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Filter\FilterInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\CountRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\LodgingRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\ListRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface;

/**
 * Service to access the Toerismevlaanderen Lodging linked open data.
 */
class LodgingService implements LodgingServiceInterface
{
    /**
     * @var \DigipolisGent\API\Client\ClientInterface
     */
    protected ClientInterface $client;

    /**
     * Create a new lodging service by injecting the client.
     *
     * @param \DigipolisGent\API\Client\ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function count(FilterInterface ...$filters): int
    {
        $request = new CountRequest(...$filters);
        /** @var \DigipolisGent\Toerismevlaanderen\Lodging\Response\CountResponse $response */
        $response = $this->client->send($request);
        return $response->count();
    }

    /**
     * @inheritDoc
     */
    public function list(FilterInterface ...$filters): array
    {
        $request = new ListRequest(...$filters);
        /** @var \DigipolisGent\Toerismevlaanderen\Lodging\Response\ListResponse $response */
        $response = $this->client->send($request);
        return $response->items();
    }

    /**
     * @inheritDoc
     */
    public function lodging(string $uri): LodgingInterface
    {
        $request = new LodgingRequest($uri);
        /** @var \DigipolisGent\Toerismevlaanderen\Lodging\Response\LodgingResponse $response */
        $response = $this->client->send($request);
        return $response->lodging();
    }
}
