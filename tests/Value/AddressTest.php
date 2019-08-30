<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates;
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
        $coordinates = Coordinates::fromLongitudeLatitude(0, 0);

        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz', $coordinates);

        $this->assertEquals('Biz', $address->getStreet());
        $this->assertEquals('1', $address->getHouseNumber());
        $this->assertEquals('b', $address->getBusNumber());
        $this->assertEquals('9000', $address->getPostalCode());
        $this->assertEquals('Baz', $address->getLocality());
        $this->assertSame($coordinates, $address->getCoordinates());
    }

    /**
     * Not the same value if street is not the same.
     *
     * @test
     */
    public function notSameValueIfStreetIsDifferent(): void
    {
        $coordinates = Coordinates::fromLongitudeLatitude(0, 0);

        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz', $coordinates);
        $otherAddress = Address::fromDetails('Foo', '1', 'b', '9000', 'Baz', $coordinates);

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Not the same value if house number is not the same.
     *
     * @test
     */
    public function notSameValueIfHouseNumberIsDifferent(): void
    {
        $coordinates = Coordinates::fromLongitudeLatitude(0, 0);

        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz', $coordinates);
        $otherAddress = Address::fromDetails('Biz', '2', 'b', '9000', 'Baz', $coordinates);

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Not the same value if bus number is not the same.
     *
     * @test
     */
    public function notSameValueIfBusNumberIsDifferent(): void
    {
        $coordinates = Coordinates::fromLongitudeLatitude(0, 0);

        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz', $coordinates);
        $otherAddress = Address::fromDetails('Biz', '1', '', '9000', 'Baz', $coordinates);

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Not the same value if postal code is not the same.
     *
     * @test
     */
    public function notSameValueIfPostalCodeIsDifferent(): void
    {
        $coordinates = Coordinates::fromLongitudeLatitude(0, 0);

        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz', $coordinates);
        $otherAddress = Address::fromDetails('Biz', '1', 'b', '9001', 'Baz', $coordinates);

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Not the same value if locality is not the same.
     *
     * @test
     */
    public function notSameValueIfLocalityIsDifferent(): void
    {
        $coordinates = Coordinates::fromLongitudeLatitude(0, 0);

        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz', $coordinates);
        $otherAddress = Address::fromDetails('Biz', '1', 'b', '9000', 'Foo', $coordinates);

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Not the same value if coordinates are not the same.
     *
     * @test
     */
    public function notSameValueIfCoordinatesAreDifferent(): void
    {
        $coordinates = Coordinates::fromLongitudeLatitude(0, 0);
        $otherCoordinates = Coordinates::fromLongitudeLatitude(50, 60);

        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz', $coordinates);
        $otherAddress = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz', $otherCoordinates);

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Same value if both share the same property values.
     *
     * @test
     */
    public function sameValueIfAllPropertiesHaveSameValue(): void
    {
        $coordinates = Coordinates::fromLongitudeLatitude(0, 0);

        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz', $coordinates);
        $otherAddress = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz', $coordinates);

        $this->assertTrue($address->sameValueAs($otherAddress));
    }

    /**
     * String contains al parts.
     *
     * @test
     */
    public function toStringContainsAllParts(): void
    {
        $coordinates = Coordinates::fromLongitudeLatitude(0, 0);

        $address = Address::fromDetails('Biz', '1', 'b', '9000', 'Baz', $coordinates);
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
        $coordinates = Coordinates::fromLongitudeLatitude(0, 0);

        $address = Address::fromDetails('Biz', '1', '', '9000', 'Baz', $coordinates);
        $this->assertEquals(
            'Biz 1, 9000 Baz',
            (string) $address
        );
    }
}
