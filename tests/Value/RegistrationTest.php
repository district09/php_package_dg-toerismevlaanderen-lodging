<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration
 */
class RegistrationTest extends TestCase
{
    /**
     * Phone number object can be created from number string.
     *
     * @test
     */
    public function registrationCanBeCreatedFromTypeAndStatus(): void
    {
        $registration = Registration::fromTypeAndStatus('Foo', 'Baz');
        $this->assertEquals('Foo', $registration->getType());
        $this->assertEquals('Baz', $registration->getStatus());
    }

    /**
     * Not the same value if type is different.
     *
     * @test
     */
    public function notSameValueIfTypeIsDifferent(): void
    {
        $registration = Registration::fromTypeAndStatus('Foo', 'Baz');
        $otherRegistration = Registration::fromTypeAndStatus('Fiz', 'Baz');

        $this->assertFalse($registration->sameValueAs($otherRegistration));
    }

    /**
     * Not the same value if status is different
     *
     * @test
     */
    public function notSameValueIfStatusIsDifferent(): void
    {
        $registration = Registration::fromTypeAndStatus('Foo', 'Baz');
        $otherRegistration = Registration::fromTypeAndStatus('Foo', 'Biz');

        $this->assertFalse($registration->sameValueAs($otherRegistration));
    }

    /**
     * Same value if type and status are the same.
     */
    public function sameValueIfTypeAndStatusAreTheSame(): void
    {
        $registration = Registration::fromTypeAndStatus('Foo', 'Baz');
        $sameRegistration = Registration::fromTypeAndStatus('Foo', 'Baz');

        $this->assertFalse($registration->sameValueAs($sameRegistration));
    }

    /**
     * String version contains the type and status.
     *
     * @test
     */
    public function castToStringReturnsNumber(): void
    {
        $registration = Registration::fromTypeAndStatus('Foo', 'Bar');
        $this->assertSame('Foo (Bar)', (string) $registration);
    }
}
