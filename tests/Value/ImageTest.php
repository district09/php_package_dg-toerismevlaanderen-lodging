<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidImage;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Image;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\Image
 */
class ImageTest extends TestCase
{
    /**
     * Exception is thrown when image URL is not valid.
     *
     * @test
     */
    public function exceptionIsThrownWhenImageUrlIsNotValid(): void
    {
        $this->expectException(InvalidImage::class);
        Image::fromUrl('foo.bar');
    }

    /**
     * Image can be created from URL string.
     *
     * @test
     */
    public function imageCanBeCreatedFromUrl(): void
    {
        $image = Image::fromUrl('http://foo.bar/image.jpg');
        $this->assertEquals('http://foo.bar/image.jpg', $image->getUrl());
    }

    /**
     * Not the same value if URL is different.
     *
     * @test
     */
    public function notSameValueIfUrlIsDifferent(): void
    {
        $image = Image::fromUrl('http://foo.bar/image.jpg');
        $otherImage = Image::fromUrl('http://foo.bar/other-image.jpg');
        $this->assertFalse($image->sameValueAs($otherImage));
    }

    /**
     * Same values if they share the same URL.
     *
     * @test
     */
    public function sameValueIfUrlIsTheSame(): void
    {
        $image = Image::fromUrl('http://foo.bar/image.jpg');
        $sameImage = Image::fromUrl('http://foo.bar/image.jpg');
        $this->assertTrue($image->sameValueAs($sameImage));
    }

    /**
     * String version contains the URL.
     *
     * @test
     */
    public function castToStringReturnsAddress(): void
    {
        $image = Image::fromUrl('http://foo.bar/image.jpg');
        $this->assertSame('http://foo.bar/image.jpg', (string) $image);
    }
}
