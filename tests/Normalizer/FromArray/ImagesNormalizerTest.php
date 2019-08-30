<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray\ImagesNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Image;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Images;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray\ImagesNormalizer
 */
class ImagesNormalizerTest extends TestCase
{
    /**
     * Images collection can be created from empty data array.
     *
     * @test
     */
    public function imagesCanBeNormalizedFromEmptyDataSet(): void
    {
        $expectedImages = Images::fromImages();

        $normalizer = new ImagesNormalizer();
        $this->assertEquals(
            $expectedImages,
            $normalizer->normalize([])
        );
    }

    /**
     * All images are normalized into the collection.
     *
     * @test
     */
    public function allImagesDataIsNormalizedIntoCollection(): void
    {
        $data = [
            'http://foo.bar/image/1.jpg',
            'http://foo.bar/image/2.jpg',
        ];

        $expectedImages = Images::fromImages(
            Image::fromUrl('http://foo.bar/image/1.jpg'),
            Image::fromUrl('http://foo.bar/image/2.jpg')
        );

        $normalizer = new ImagesNormalizer();
        $this->assertEquals(
            $expectedImages,
            $normalizer->normalize($data)
        );
    }
}
