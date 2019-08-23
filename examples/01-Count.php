<?php

/**
 * Example how to count (filtered) the number of lodgings.
 */

use DigipolisGent\API\Client\Configuration\Configuration;
use DigipolisGent\Toerismevlaanderen\Lodging\Client\Client;
use DigipolisGent\Toerismevlaanderen\Lodging\Filter\LocalityFilter;
use DigipolisGent\Toerismevlaanderen\Lodging\Filter\RegistrationStatusFilter;
use DigipolisGent\Toerismevlaanderen\Lodging\LodgingServiceFactory;

require_once __DIR__ . '/bootstrap.php';

// Start output.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo 'Count the number of lodges in Gent.' . PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;

echo ' → Create the API client configuration.' . PHP_EOL;
$configuration = new Configuration($apiEndpoint);

echo ' → Create the Guzzle client.' . PHP_EOL;
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

echo ' → Create the HTTP client.' . PHP_EOL;
$client = new Client($guzzleClient, $configuration);

echo ' → Create the Site Service wrapper.' . PHP_EOL;
$service = LodgingServiceFactory::create($client);

echo ' → Count the number of lodges in Gent that are "Erkend" or "Vergund".' . PHP_EOL;
$count = $service->count(
    new LocalityFilter('Gent'),
    new RegistrationStatusFilter('Erkend', 'Vergund')
);

echo PHP_EOL;
echo sprintf(' COUNT : %s', $count) . PHP_EOL;

// End.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;
