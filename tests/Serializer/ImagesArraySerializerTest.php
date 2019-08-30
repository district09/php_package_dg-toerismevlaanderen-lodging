<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Serializer\ImagesArraySerializer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Image;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Images;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Serializer\ImagesArraySerializer
 */
class ImagesArraySerializerTest extends TestCase
{
    /**
     * Array contains all image URLs.
     *
     * @test
     */
    public function imagesArrayContainsAllUrls(): void
    {
        $images = Images::fromImages(
            Image::fromUrl('http://foo.bar/image/1.jpg'),
            Image::fromUrl('http://foo.bar/image/2.jpg')
        );

        $expectedArray = [
            'http://foo.bar/image/1.jpg',
            'http://foo.bar/image/2.jpg',
        ];

        $serializer = new ImagesArraySerializer();
        $this->assertEquals($expectedArray, $serializer->serialize($images));
    }
}
