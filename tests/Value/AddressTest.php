<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\Address
 */
class AddressTest extends TestCase
{
    /**
     * Address created from its parts contains all data.
     *
     * @test
     */
    public function createFromPartsContainsAllData(): void
    {
        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz');
        $this->assertEquals('Biz', $address->getStreet());
        $this->assertEquals('1', $address->getHouseNumber());
        $this->assertEquals('b', $address->getBusNumber());
        $this->assertEquals('9000', $address->getPostalCode());
        $this->assertEquals('Baz', $address->getLocality());
    }

    /**
     * Not the same value if street is not the same.
     *
     * @test
     */
    public function notSameValueIfStreetIsDifferent(): void
    {
        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz');
        $otherAddress = Address::fromDetails('Foo', '1', 'b', '9000', 'Baz');

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Not the same value if house number is not the same.
     *
     * @test
     */
    public function notSameValueIfHouseNumberIsDifferent(): void
    {
        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz');
        $otherAddress = Address::fromDetails('Biz', '2', 'b', '9000', 'Baz');

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Not the same value if bus number is not the same.
     *
     * @test
     */
    public function notSameValueIfBusNumberIsDifferent(): void
    {
        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz');
        $otherAddress = Address::fromDetails('Biz', '1', '', '9000', 'Baz');

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Not the same value if postal code is not the same.
     *
     * @test
     */
    public function notSameValueIfPostalCodeIsDifferent(): void
    {
        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz');
        $otherAddress = Address::fromDetails('Biz', '1', 'b', '9001', 'Baz');

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Not the same value if locality is not the same.
     *
     * @test
     */
    public function notSameValueIfLocalityIsDifferent(): void
    {
        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz');
        $otherAddress = Address::fromDetails('Biz', '1', 'b', '9000', 'Foo');

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Same value if both share the same property values.
     *
     * @test
     */
    public function sameValueIfAllPropertiesHaveSameValue(): void
    {
        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz');
        $otherAddress = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz');

        $this->assertTrue($address->sameValueAs($otherAddress));
    }

    /**
     * String contains al parts.
     *
     * @test
     */
    public function toStringContainsAllParts(): void
    {
        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz');
        $this->assertEquals(
            'Biz 1 b, 9000 Baz',
            (string) $address
        );
    }

    /**
     * No bus number if value is empty.
     *
     * @test
     */
    public function toStringContainsNoBusNumberIfValueIsEmpty(): void
    {
        $address = Address::fromDetails('Biz', '1', '', '9000', 'Baz');
        $this->assertEquals(
            'Biz 1, 9000 Baz',
            (string) $address
        );
    }
}
