<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers
 */
class PhoneNumbersTest extends TestCase
{
    /**
     * To string returns the phone numbers separated by ", ".
     *
     * @test
     */
    public function toStringReturnsPhoneNumbersSeparatedByComma(): void
    {
        $phoneNumbers = PhoneNumbers::fromPhoneNumbers(
            PhoneNumber::fromNumber('+32 9 123 12 12'),
            PhoneNumber::fromNumber('+32 9 123 12 13')
        );

        $this->assertEquals(
            '+32 9 123 12 12, +32 9 123 12 13',
            (string) $phoneNumbers
        );
    }
}
