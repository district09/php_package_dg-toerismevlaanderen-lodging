<?php

/**
 * Try to load all lodgings from the list.
 *
 * This script gets the list of lodgings and tries to load one-by-one.
 * It will report what lodgings could not be loaded.
 */

use DigipolisGent\API\Client\Configuration\Configuration;
use DigipolisGent\Toerismevlaanderen\Lodging\Client\Client;
use DigipolisGent\Toerismevlaanderen\Lodging\Filter\LocalityFilter;
use DigipolisGent\Toerismevlaanderen\Lodging\Filter\RegistrationStatusFilter;
use DigipolisGent\Toerismevlaanderen\Lodging\LodgingServiceFactory;

require_once __DIR__ . '/bootstrap.php';

// Start output.
echo PHP_EOL;
echo str_repeat('-', 80), PHP_EOL;
echo 'Try to load all lodgings in Gent.', PHP_EOL;
echo str_repeat('-', 80), PHP_EOL;
echo PHP_EOL;

echo ' → Create the API client configuration.', PHP_EOL;
$configuration = new Configuration($apiEndpoint);

echo ' → Create the Guzzle client.', PHP_EOL;
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

echo ' → Create the HTTP client.', PHP_EOL;
$client = new Client($guzzleClient, $configuration);

echo ' → Create the Site Service wrapper.', PHP_EOL;
$service = LodgingServiceFactory::create($client);

echo ' → Load list of lodgings in Gent that are "Erkend" or "Vergund".', PHP_EOL;
$listItems = $service->list(
    new LocalityFilter('Gent'),
    new RegistrationStatusFilter('Erkend', 'Vergund')
);

echo ' → Try to load the details of each lodging.', PHP_EOL;

$countOk = 0;
$countError = 0;
foreach ($listItems as $listItem) {
    /* @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem $listItem */
    echo sprintf(
        '   • Load lodging %s %s',
        $listItem->lodgingId()->getUri(),
        $listItem->getName()
    ), PHP_EOL;
    try {
        $service->lodging($listItem->lodgingId()->getUri());
        echo '     OK', PHP_EOL;
        $countOk++;
    } catch (Exception $exception) {
        echo sprintf('     ERROR (%s):', get_class($exception)), PHP_EOL;
        echo sprintf('     %s', $exception->getMessage()), PHP_EOL;
        $countError++;
    }
}

echo PHP_EOL;
echo sprintf(' TOTAL : %d', count($listItems)), PHP_EOL;
echo sprintf(' OK    : %d', $countOk), PHP_EOL;
echo sprintf(' ERROR : %d', $countError), PHP_EOL;

// End.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;
