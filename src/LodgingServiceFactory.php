<?php

namespace DigipolisGent\Toerismevlaanderen\Lodging;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Handler\CountHandler;
use DigipolisGent\Toerismevlaanderen\Lodging\Handler\LodgingHandler;
use DigipolisGent\Toerismevlaanderen\Lodging\Handler\ListHandler;

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
        $client->addHandler(new ListHandler());
        $client->addHandler(new LodgingHandler());

        return new LodgingService($client);
    }
}
