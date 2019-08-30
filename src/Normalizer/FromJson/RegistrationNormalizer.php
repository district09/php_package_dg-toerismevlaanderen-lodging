<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;

/**
 * Normalizer to get the registration out of json decoded data.
 */
class RegistrationNormalizer
{
    /**
     * Extract the registration object from the json data.
     *
     * @param object $lodgingData
     * @param string $prefix
     *   The prefix of the registration variables.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration
     */
    public function normalize(object $lodgingData, string $prefix): Registration
    {
        return Registration::fromTypeAndStatus(
            $lodgingData->{$prefix . '_type'}->value,
            $lodgingData->{$prefix . '_status'}->value
        );
    }
}
