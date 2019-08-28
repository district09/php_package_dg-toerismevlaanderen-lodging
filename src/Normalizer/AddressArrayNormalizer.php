<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;

/**
 * Normalizes an array of data into an Address value.
 */
final class AddressArrayNormalizer
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
            $data['locality'] ?? ''
        );
    }
}
