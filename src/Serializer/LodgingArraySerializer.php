<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Serializer;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface;

/**
 * Serializes a Lodging value into an array.
 */
final class LodgingArraySerializer
{
    /**
     * Serializes a given Lodging value into an array of data.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface $lodging
     *
     * @return array
     */
    public function serialize(LodgingInterface $lodging): array
    {
        return [
            'lodgingId' => $lodging->getLodgingId()->getUri(),
            'name' => $lodging->getName(),
            'description' => $lodging->getDescription(),
            'numberOfSleepingPlaces' => $lodging->getNumberOfSleepingPlaces(),
            'registration' => [
                'type' => $lodging->getRegistration()->getType(),
                'status' => $lodging->getRegistration()->getStatus(),
            ],
            'receptionAddress' => (new AddressArraySerializer())->serialize($lodging->getReceptionAddress()),
            'contactPoint' => (new ContactInfoArraySerializer())->serialize($lodging->getContactPoint()),
            'rating' => (string) $lodging->getRating(),
            'qualityLabels' => $lodging->getQualityLabels()->getLabels(),
            'images' => (new ImagesArraySerializer())->serialize($lodging->getImages()),
        ];
    }
}
