<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Image;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Images;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\Images
 */
class ImagesTest extends TestCase
{
    /**
     * To string returns the image url's separated by ", ".
     *
     * @test
     */
    public function toStringReturnsImageUrlsSeparatedByComma(): void
    {
        $images = Images::fromImages(
            Image::fromUrl('http://foo.bar/image1.jpg'),
            Image::fromUrl('http://foo.bar/image2.jpg')
        );

        $this->assertEquals(
            'http://foo.bar/image1.jpg, http://foo.bar/image2.jpg',
            (string) $images
        );
    }
}
