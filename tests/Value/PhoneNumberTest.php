<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber
 */
class PhoneNumberTest extends TestCase
{
    /**
     * Phone number object can be created from number string.
     *
     * @test
     */
    public function phoneNumberCanBeCreatedFromString(): void
    {
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $this->assertEquals('+32 9 123 12 12', $phoneNumber->getNumber());
    }

    /**
     * Not the same value if numbers are different.
     *
     * @test
     */
    public function notSameValueIfNumberIsDifferent(): void
    {
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $differentPhoneNumber = PhoneNumber::fromNumber('+32 9 123 12 13');
        $this->assertFalse($phoneNumber->sameValueAs($differentPhoneNumber));
    }

    /**
     * Same values if they share the same number.
     *
     * @test
     */
    public function sameValueIfNumbersAreTheSame(): void
    {
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $samePhoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $this->assertTrue($phoneNumber->sameValueAs($samePhoneNumber));
    }

    /**
     * String version contains the phone number.
     *
     * @test
     */
    public function castToStringReturnsNumber(): void
    {
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $this->assertSame('+32 9 123 12 12', (string) $phoneNumber);
    }
}
