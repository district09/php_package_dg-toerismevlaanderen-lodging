<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Serializer;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;

/**
 * Serializes an Address value into an array.
 */
final class AddressArraySerializer
{
    /**
     * Serializes a given Address value into an array of data.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\Address $address
     *
     * @return array
     */
    public function serialize(Address $address): array
    {
        return [
            'street' => $address->getStreet(),
            'houseNumber' => $address->getHouseNumber(),
            'busNumber' => $address->getBusNumber(),
            'postalCode' => $address->getPostalCode(),
            'locality' => $address->getLocality(),
        ];
    }
}
