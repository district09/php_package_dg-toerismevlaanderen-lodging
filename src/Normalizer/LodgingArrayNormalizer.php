<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;

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
        $lodgingId = LodgingId::fromUri($data['_lodging']);

        $name = $data['name'];
        $description = $data['description'] ?? '';
        $numberOfSleepingPlaces = (int) $data['numberOfSleepingPlaces'];

        $registration = Registration::fromTypeAndStatus(
            $data['type'],
            $data['registrationStatus']
        );
        $starRating = StarRating::fromEuropeanFormat($data['starRating']);

        $contactPointNormalizer = new ContactPointArrayNormalizer();
        $contactPoint = $contactPointNormalizer->normalize($data);

        return Lodging::fromDetails(
            $lodgingId,
            $name,
            $description,
            $numberOfSleepingPlaces,
            $registration,
            $contactPoint,
            $starRating
        );
    }
}
