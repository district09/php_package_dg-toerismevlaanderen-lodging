<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Serializer;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Images;

/**
 * Serializes an Images collection value into an array.
 */
final class ImagesArraySerializer
{
    /**
     * Serializes a given Images collection value into an array of data.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\Images $images
     *
     * @return array
     */
    public function serialize(Images $images): array
    {
        $data = [];
        foreach ($images->getIterator() as $image) {
            /* @var $image \DigipolisGent\Toerismevlaanderen\Lodging\Value\Image */
            $data[] = $image->getUrl();
        }

        return $data;
    }
}
