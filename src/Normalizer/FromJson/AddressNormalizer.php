<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates;

/**
 * Normalizer to get the reception address out of json decoded data.
 */
class AddressNormalizer
{
    /**
     * Extract the reception address from the json data.
     *
     * @param object $lodgingData
     * @param string $prefix
     *   The prefix of the address variables.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Address
     */
    public function normalize(object $lodgingData, string $prefix): Address
    {
        return Address::fromDetails(
            $lodgingData->{$prefix . '_street'}->value ?? '',
            $lodgingData->{$prefix . '_houseNumber'}->value ?? '',
            $lodgingData->{$prefix . '_busNumber'}->value ?? '',
            $lodgingData->{$prefix . '_postalCode'}->value ?? '',
            $lodgingData->{$prefix . '_locality'}->value ?? '',
            Coordinates::fromLongitudeLatitude(
                (float) ($lodgingData->{$prefix . '_longitude'}->value ?? 0),
                (float) ($lodgingData->{$prefix . '_latitude'}->value ?? 0)
            )
        );
    }
}
