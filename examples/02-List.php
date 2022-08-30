<?php

/**
 * Example how to get a (filtered) list of lodgings.
 *
 * @var string $apiEndpoint
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
echo 'Get a list lodgings in Gent.' . PHP_EOL;
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

echo ' → List of lodgings in Gent that are "Erkend" or "Vergund".' . PHP_EOL;
$listItems = $service->list(
    new LocalityFilter('Gent'),
    new RegistrationStatusFilter('Erkend', 'Vergund')
);
foreach ($listItems as $listItem) {
    /* @var $listItem \DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem */
    echo sprintf('   • %s', $listItem->lodgingId()->getUri()), PHP_EOL;
    echo sprintf('     %s : %s', $listItem->lodgingId(), $listItem->getName()),  PHP_EOL;
}

echo PHP_EOL;
echo sprintf(' COUNT : %s', count($listItems)), PHP_EOL;

// End.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;
