<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Exception;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidCoordinates;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidCoordinates
 */
class InvalidCoordinatesTest extends TestCase
{
    /**
     * Proper message is set when longitude is outside its bounds.
     *
     * @test
     */
    public function exceptionForLongitudeOutsideBoundsHasProperMessage(): void
    {
        $exception = InvalidCoordinates::longitudeOutsideBounds(200.25);
        $this->assertEquals(
            'Longitude "200.25" is outside -180° > 180° bounds.',
            $exception->getMessage()
        );
        $this->assertSame(400, $exception->getCode());
    }

    /**
     * Proper message is set when latitude is outside its bounds.
     *
     * @test
     */
    public function exceptionForLatitudeOutsideBoundsHasProperMessage(): void
    {
        $exception = InvalidCoordinates::latitudeOutsideBounds(105.123);
        $this->assertEquals(
            'Latitude "105.123" is outside -90° > 90° bounds.',
            $exception->getMessage()
        );
        $this->assertSame(400, $exception->getCode());
    }
}
