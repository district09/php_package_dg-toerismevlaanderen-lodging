<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;

/**
 * Normalizes an array of lodging data to a Lodging value.
 */
final class LodgingArrayNormalizer
{
    /**
     * Normalizes a given array of lodging data into a Lodging value.
     *
     * @param array $data
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging
     */
    public function normalize(array $data): Lodging
    {
        $registration = Registration::fromTypeAndStatus(
            $data['registration']['type'],
            $data['registration']['status']
        );

        $addressArrayNormalizer = new AddressArrayNormalizer();
        $contactInfoNormalizer = new ContactInfoArrayNormalizer();
        $imagesArrayNormalizer = new ImagesArrayNormalizer();

        return Lodging::fromDetails(
            LodgingId::fromUri($data['lodgingId']),
            $data['name'],
            $data['description'] ?? '',
            (int) $data['numberOfSleepingPlaces'],
            $registration,
            $addressArrayNormalizer->normalize($data['receptionAddress'] ?? []),
            $contactInfoNormalizer->normalize($data['contactPoint'] ?? []),
            StarRating::fromEuropeanFormat($data['starRating']),
            $data['qualityLabels'] ?? [],
            $imagesArrayNormalizer->normalize($data['images'] ?? [])
        );
    }
}
