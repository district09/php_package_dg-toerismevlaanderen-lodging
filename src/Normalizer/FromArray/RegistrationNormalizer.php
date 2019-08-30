<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;

/**
 * Normalizes an array of registration data into a Registration value.
 */
final class RegistrationNormalizer
{
    /**
     * Normalizes a given array containing registration values.
     *
     * @param array $data
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration
     */
    public function normalize(array $data): Registration
    {
        return Registration::fromTypeAndStatus(
            $data['type'],
            $data['status']
        );
    }
}
