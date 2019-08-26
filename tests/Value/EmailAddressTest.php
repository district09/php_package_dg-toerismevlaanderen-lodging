<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidEmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress
 */
class EmailAddressTest extends TestCase
{
    /**
     * Exception is thrown when e-mail address is not valid.
     *
     * @test
     */
    public function exceptionIsThrownWhenAddressIsNotValidEmail(): void
    {
        $this->expectException(InvalidEmailAddress::class);
        EmailAddress::fromAddress('foo.bar');
    }

    /**
     * Email address can be created from address string.
     *
     * @test
     */
    public function emailAddressCanBeCreatedFromString(): void
    {
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $this->assertEquals('foo@biz.baz', $emailAddress->getAddress());
    }

    /**
     * Empty email address can be created.
     *
     * @test
     */
    public function phoneNumberCanBeCreatedWithoutNumber(): void
    {
        $emailAddress = EmailAddress::withoutAddress();
        $this->assertEquals('', $emailAddress->getAddress());
    }

    /**
     * Not the same value if addresses are different.
     *
     * @test
     */
    public function notSameValueIfAddressIsDifferent(): void
    {
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $differentEmailAddress = EmailAddress::fromAddress('bar@biz.baz');
        $this->assertFalse($emailAddress->sameValueAs($differentEmailAddress));
    }

    /**
     * Same values if they share the same number.
     *
     * @test
     */
    public function sameValueIfAddressesAreTheSame(): void
    {
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $sameEmailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $this->assertTrue($emailAddress->sameValueAs($sameEmailAddress));
    }

    /**
     * String version contains the address.
     *
     * @test
     */
    public function castToStringReturnsAddress(): void
    {
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $this->assertSame('foo@biz.baz', (string) $emailAddress);
    }
}
