<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromString\RatingNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface;

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
        return Lodging::fromDetails(
            LodgingId::fromUri($data['lodgingId']),
            $data['name'],
            $data['description'] ?? '',
            (int) $data['numberOfSleepingPlaces'],
            (new RegistrationNormalizer())->normalize($data['registration']),
            (new AddressNormalizer())->normalize($data['receptionAddress'] ?? []),
            (new ContactInfoNormalizer())->normalize($data['contactPoint'] ?? []),
            (new RatingNormalizer())->normalize($data['rating'] ?? null),
            (new QualityLabelsNormalizer())->normalize($data['qualityLabels'] ?? []),
            (new ImagesNormalizer())->normalize($data['images'] ?? [])
        );
    }
}
