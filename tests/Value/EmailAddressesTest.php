<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses
 */
class EmailAddressesTest extends TestCase
{
    /**
     * To string returns the email addresses separated by ", ".
     *
     * @test
     */
    public function toStringReturnsEmailAddressesSeparatedByComma(): void
    {
        $emailAddresses = EmailAddresses::fromEmailAddresses(
            EmailAddress::fromAddress('jane@biz.baz'),
            EmailAddress::fromAddress('john@biz.baz')
        );

        $this->assertEquals(
            'jane@biz.baz, john@biz.baz',
            (string) $emailAddresses
        );
    }
}
