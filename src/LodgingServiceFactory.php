<?php

namespace DigipolisGent\Toerismevlaanderen\Lodging;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Handler\CountHandler;

/**
 * Class JobServiceFactory
 */
class LodgingServiceFactory
{
    /**
     * @param ClientInterface $client
     *
     * @return LodgingService
     */
    public static function create(ClientInterface $client): LodgingService
    {
        $client->addHandler(new CountHandler());

        return new LodgingService($client);
    }
}
