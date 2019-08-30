<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidCoordinates;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates
 */
class CoordinatesTest extends TestCase
{
    /**
     * Exception is thrown when longitude is not valid.
     *
     * @test
     */
    public function exceptionIsThrownWhenLongitudeIsNotValid(): void
    {
        $this->expectException(InvalidCoordinates::class);
        Coordinates::fromLongitudeLatitude(200, 0);
    }

    /**
     * Exception is thrown when latitude is not valid.
     *
     * @test
     */
    public function exceptionIsThrownWhenLatitudeIsNotValid(): void
    {
        $this->expectException(InvalidCoordinates::class);
        Coordinates::fromLongitudeLatitude(0, 91);
    }

    /**
     * Coordinates can be created from longitude, latitude.
     *
     * @test
     */
    public function coordinatesCanBeCreatedFromLongitudeLatitude(): void
    {
        $coordinates = Coordinates::fromLongitudeLatitude(5, 50);
        $this->assertEquals(5, $coordinates->getLongitude());
        $this->assertEquals(50, $coordinates->getLatitude());
    }

    /**
     * Not the same value if longitude is different.
     *
     * @test
     */
    public function notSameValueIfLongitudeIsDifferent(): void
    {
        $coordinates = Coordinates::fromLongitudeLatitude(0, 0);
        $differentCoordinates = Coordinates::fromLongitudeLatitude(1, 0);
        $this->assertFalse($coordinates->sameValueAs($differentCoordinates));
    }

    /**
     * Not the same value if latitude is different.
     *
     * @test
     */
    public function notSameValueIfLatitudeIsDifferent(): void
    {
        $coordinates = Coordinates::fromLongitudeLatitude(0, 0);
        $differentCoordinates = Coordinates::fromLongitudeLatitude(0, -1);
        $this->assertFalse($coordinates->sameValueAs($differentCoordinates));
    }

    /**
     * Same values if they share the same longitude & latitude.
     *
     * @test
     */
    public function sameValueIfLongitudeAndLatitudeIsTheSame(): void
    {
        $coordinates = Coordinates::fromLongitudeLatitude(0, 0);
        $sameCoordinates = Coordinates::fromLongitudeLatitude(0, 0);
        $this->assertTrue($coordinates->sameValueAs($sameCoordinates));
    }

    /**
     * String version contains the POINT(long lat) notation.
     *
     * @test
     */
    public function castToStringReturnsPointNotation(): void
    {
        $coordinates = Coordinates::fromLongitudeLatitude(50.123, 60.456);
        $this->assertSame('POINT (50.123 60.456)', (string) $coordinates);
    }
}
