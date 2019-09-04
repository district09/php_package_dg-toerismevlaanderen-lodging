<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;

/**
 * Normalizes an array of lodging data to a Lodging value.
 */
final class LodgingNormalizer
{
    /**
     * Normalizes a given array of lodging data into a Lodging value.
     *
     * @param array $data
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface
     */
    public function normalize(array $data): LodgingInterface
    {
        $registrationNormalizer = new RegistrationNormalizer();
        $addressNormalizer = new AddressNormalizer();
        $contactNormalizer = new ContactInfoNormalizer();
        $qualityLabelsNormalizer = new QualityLabelsNormalizer();
        $imagesNormalizer = new ImagesNormalizer();

        return Lodging::fromDetails(
            LodgingId::fromUri($data['lodgingId']),
            $data['name'],
            $data['description'] ?? '',
            (int) $data['numberOfSleepingPlaces'],
            $registrationNormalizer->normalize($data['registration']),
            $addressNormalizer->normalize($data['receptionAddress'] ?? []),
            $contactNormalizer->normalize($data['contactPoint'] ?? []),
            StarRating::fromEuropeanFormat($data['starRating']),
            $qualityLabelsNormalizer->normalize($data['qualityLabels'] ?? []),
            $imagesNormalizer->normalize($data['images'] ?? [])
        );
    }
}
