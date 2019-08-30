<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates;

/**
 * Normalizes an array of data into an Address value.
 */
final class AddressNormalizer
{
    /**
     * Normalizes a given array containing address data into an Address value.
     *
     * @param array $data
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Address
     */
    public function normalize(array $data): Address
    {
        return Address::fromDetails(
            $data['street'] ?? '',
            $data['houseNumber'] ?? '',
            $data['busNumber'] ?? '',
            $data['postalCode'] ?? '',
            $data['locality'] ?? '',
            Coordinates::fromLongitudeLatitude(
                (float) ($data['coordinates']['longitude'] ?? 0),
                (float) ($data['coordinates']['latitude'] ?? 0)
            )
        );
    }
}
