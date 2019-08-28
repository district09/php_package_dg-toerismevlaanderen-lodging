<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Serializer;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;

/**
 * Serializes a Lodging value into an array.
 */
final class LodgingArraySerializer
{
    /**
     * Serializes a given Lodging value into an array of data.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging $lodging
     *
     * @return array
     */
    public function serialize(Lodging $lodging): array
    {
        $contactInfoSerializer = new ContactInfoArraySerializer();

        return [
            'lodgingId' => $lodging->getLodgingId()->getUri(),
            'name' => $lodging->getName(),
            'description' => $lodging->getDescription(),
            'numberOfSleepingPlaces' => $lodging->getNumberOfSleepingPlaces(),
            'registration' => [
                'type' => $lodging->getRegistration()->getType(),
                'status' => $lodging->getRegistration()->getStatus(),
            ],
            'contactPoint' => $contactInfoSerializer->serialize($lodging->getContactPoint()),
            'starRating' => (string) $lodging->getStarRating(),
        ];
    }
}
