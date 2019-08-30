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
        $addressSerializer = new AddressArraySerializer();
        $contactInfoSerializer = new ContactInfoArraySerializer();
        $imagesSerializer = new ImagesArraySerializer();

        return [
            'lodgingId' => $lodging->getLodgingId()->getUri(),
            'name' => $lodging->getName(),
            'description' => $lodging->getDescription(),
            'numberOfSleepingPlaces' => $lodging->getNumberOfSleepingPlaces(),
            'registration' => [
                'type' => $lodging->getRegistration()->getType(),
                'status' => $lodging->getRegistration()->getStatus(),
            ],
            'receptionAddress' => $addressSerializer->serialize($lodging->getReceptionAddress()),
            'contactPoint' => $contactInfoSerializer->serialize($lodging->getContactPoint()),
            'starRating' => (string) $lodging->getStarRating(),
            'qualityLabels' => $lodging->getQualityLabels()->getLabels(),
            'images' => $imagesSerializer->serialize($lodging->getImages()),
        ];
    }
}
