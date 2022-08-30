<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromString\RatingNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface;

/**
 * Normalizes a json string into a Lodging value.
 */
final class LodgingNormalizer
{
    /**
     * Normalizes a given json containing lodging data into a Lodging value.
     *
     * @param string $json
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface
     */
    public function normalize(string $json): LodgingInterface
    {
        $data = json_decode($json);
        $lodgingData = $data->results->bindings[0];

        return Lodging::fromDetails(
            LodgingId::fromUri($lodgingData->_lodging->value),
            $lodgingData->name->value,
            $lodgingData->description->value ?? '',
            (int) $lodgingData->numberOfSleepingPlaces->value,
            (new RegistrationNormalizer())->normalize($lodgingData, 'registration'),
            (new AddressNormalizer())->normalize($lodgingData, 'receptionAddress'),
            (new ContactInfoNormalizer())->normalize($lodgingData, 'contactPoint'),
            (new RatingNormalizer())->normalize($lodgingData->rating->value ?? null),
            (new QualityLabelsNormalizer())->normalize($lodgingData),
            (new ImagesNormalizer())->normalize($lodgingData)
        );
    }
}
