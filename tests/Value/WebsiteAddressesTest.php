<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses
 */
class WebsiteAddressesTest extends TestCase
{
    /**
     * To string returns the website addresses separated by ", ".
     *
     * @test
     */
    public function toStringReturnsWebsiteAddressesSeparatedByComma(): void
    {
        $websiteAddresses = WebsiteAddresses::fromWebsiteAddresses(
            WebsiteAddress::fromUrl('https://foo.biz'),
            WebsiteAddress::fromUrl('https://foo.baz')
        );

        $this->assertEquals(
            'https://foo.biz, https://foo.baz',
            (string) $websiteAddresses
        );
    }
}
