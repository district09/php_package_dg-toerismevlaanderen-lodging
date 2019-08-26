<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Exception;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidStarRating;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidStarRating
 */
class InvalidStarRatingTest extends TestCase
{
    /**
     * Proper message is set when created from invalid European format.
     *
     * @test
     */
    public function exceptionFromInvalidEuropeanFormatContainsProperMessage(): void
    {
        $exception = InvalidStarRating::notInEuropeanFormat('*****');
        $this->assertEquals(
            '"*****" is not in the European Hotelstar\'s Union format.',
            $exception->getMessage()
        );
        $this->assertSame(400, $exception->getCode());
    }
}
