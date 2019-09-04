<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidWebsiteAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress
 */
class WebsiteAddressTest extends TestCase
{
    /**
     * Exception is thrown when website address URL is not valid.
     *
     * @test
     */
    public function exceptionIsThrownWhenUrlIsNotValid(): void
    {
        $this->expectException(InvalidWebsiteAddress::class);
        WebsiteAddress::fromUrl('foo.bar');
    }

    /**
     * Website address can be created from an URL.
     *
     * @test
     */
    public function websiteAddressCanBeCreatedFromUrl(): void
    {
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');
        $this->assertSame('http://foo.bar', $websiteAddress->getUrl());
    }

    /**
     * Not the same value if URLs are different.
     *
     * @test
     */
    public function notSameValueIfUrlIsDifferent(): void
    {
        $websiteAddress = WebsiteAddress::fromUrl('http://biz.baz');
        $differentWebsiteAddress = WebsiteAddress::fromUrl('http://foo.baz');
        $this->assertFalse($websiteAddress->sameValueAs($differentWebsiteAddress));
    }

    /**
     * Same values if they share the same URL.
     *
     * @test
     */
    public function sameValueIfUrlsAreTheSame(): void
    {
        $websiteAddress = WebsiteAddress::fromUrl('http://biz.baz');
        $sameWebsiteAddress = WebsiteAddress::fromUrl('http://biz.baz');
        $this->assertTrue($websiteAddress->sameValueAs($sameWebsiteAddress));
    }

    /**
     * String version contains the URL.
     *
     * @test
     */
    public function castToStringReturnsUrl(): void
    {
        $websiteAddress = WebsiteAddress::fromUrl('http://biz.baz');
        $this->assertSame('http://biz.baz', (string) $websiteAddress);
    }
}
