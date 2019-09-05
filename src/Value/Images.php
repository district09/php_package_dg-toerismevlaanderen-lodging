<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of images.
 */
final class Images extends CollectionAbstract
{
    /**
     * Create a collection from zero or more Images.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\Image ...$images
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Images
     */
    public static function fromImages(Image ...$images): Images
    {
        $collection = new static();
        $collection->values = $images;
        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $urls = [];
        foreach ($this->getIterator() as $image) {
            /* @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\Image $image */
            $urls[] = $image->getUrl();
        }

        return implode(', ', $urls);
    }
}
