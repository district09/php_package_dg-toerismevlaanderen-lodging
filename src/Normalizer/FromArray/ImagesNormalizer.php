<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Image;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Images;

/**
 * Normalizes an array of data into a Images collection value.
 */
final class ImagesNormalizer
{
    /**
     * Normalizes a given array containing image URL's.
     *
     * @param array $data
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Images
     */
    public function normalize(array $data): Images
    {
        $images = [];
        foreach ($data as $imageUrl) {
            $images[] = Image::fromUrl($imageUrl);
        }

        return Images::fromImages(...$images);
    }
}
