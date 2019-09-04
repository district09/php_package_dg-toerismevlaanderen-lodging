<?php

/**
 * Example how to get the details of a lodging.
 */

use DigipolisGent\API\Client\Configuration\Configuration;
use DigipolisGent\Toerismevlaanderen\Lodging\Client\Client;
use DigipolisGent\Toerismevlaanderen\Lodging\LodgingServiceFactory;

require_once __DIR__ . '/bootstrap.php';

// Start output.
echo PHP_EOL;
echo str_repeat('-', 80), PHP_EOL;
echo 'Get the lodging details.', PHP_EOL;
echo str_repeat('-', 80), PHP_EOL;
echo PHP_EOL;

if ($argc !== 2) {
    echo 'Usage:', PHP_EOL;
    echo PHP_EOL;
    echo sprintf('$ %s [uri]', $argv[0]), PHP_EOL;
    echo PHP_EOL;
    echo 'Where [uri] is the URI for the lodging you want the details of (see 02-List.php).', PHP_EOL;
    echo PHP_EOL;
    echo str_repeat('-', 80), PHP_EOL;
    echo PHP_EOL;
    exit();
}
$uri = $argv[1];

echo ' → Create the API client configuration.', PHP_EOL;
$configuration = new Configuration($apiEndpoint);

echo ' → Create the Guzzle client.', PHP_EOL;
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

echo ' → Create the HTTP client.', PHP_EOL;
$client = new Client($guzzleClient, $configuration);

echo ' → Create the Service wrapper.', PHP_EOL;
$service = LodgingServiceFactory::create($client);

echo sprintf(' → Lodging details of lodging with URI "%s".', $uri), PHP_EOL;
$lodging = $service->lodging($uri);
echo sprintf('   • Id                : %s', $lodging->getLodgingId()), PHP_EOL;
echo sprintf('   • URI               : %s', $lodging->getLodgingId()->getUri()), PHP_EOL;
echo sprintf('   • Name              : %s', $lodging->getName()), PHP_EOL;
echo sprintf('   • Description       : %s', $lodging->getDescription()), PHP_EOL;
echo sprintf('   • SleepingPlaces    : %d', $lodging->getNumberOfSleepingPlaces()), PHP_EOL;

echo sprintf(
    '   • Reception address : %s %s %s',
    $lodging->getReceptionAddress()->getStreet(),
    $lodging->getReceptionAddress()->getHouseNumber(),
    $lodging->getReceptionAddress()->getBusNumber()
), PHP_EOL;
echo sprintf(
    '                         %s %s',
    $lodging->getReceptionAddress()->getPostalCode(),
    $lodging->getReceptionAddress()->getLocality()
), PHP_EOL;

echo sprintf(
    '   • Contact point     : t %s',
    $lodging->getContactPoint()->getPhoneNumber()
), PHP_EOL;
echo sprintf(
    '                         m %s',
    $lodging->getContactPoint()->getEmailAddress()
), PHP_EOL;
echo sprintf(
    '                         w %s',
    $lodging->getContactPoint()->getWebsiteAddress()
), PHP_EOL;

echo sprintf('   • Type              : %s', $lodging->getRegistration()->getType()), PHP_EOL;
echo sprintf('   • Status            : %s', $lodging->getRegistration()->getStatus()), PHP_EOL;
echo sprintf('   • Star rating       : %s', $lodging->getStarRating()), PHP_EOL;
echo sprintf('   • Quality labels    : %s', $lodging->getQualityLabels()), PHP_EOL;
echo sprintf('   • Images            : %s', $lodging->getImages()), PHP_EOL;

echo PHP_EOL;

// End.
echo PHP_EOL;
echo str_repeat('-', 80), PHP_EOL;
echo PHP_EOL;
