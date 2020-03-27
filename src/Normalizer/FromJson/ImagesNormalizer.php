<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Image;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Images;

/**
 * Normalizer to get the images out of json decoded data.
 */
class ImagesNormalizer
{
    /**
     * Extract the images from the json data.
     *
     * @param object $lodgingData
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Images
     */
    public function normalize(object $lodgingData): Images
    {
        if (empty($lodgingData->images->value)) {
            return Images::fromImages();
        }

        $images = [];
        $imageUrls = explode(',', $lodgingData->images->value);
        foreach ($imageUrls as $imageUrl) {
            $images[] = Image::fromUrl($imageUrl);
        }
        $images = array_reverse($images);

        return Images::fromImages(...$images);
    }
}
