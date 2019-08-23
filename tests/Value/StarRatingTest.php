<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidStarRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating
 */
class StarRatingTest extends TestCase
{
    /**
     * Exception thrown provided star rating is not in proper format.
     *
     * The rating should be in the European Hotelstar's Union format.
     *
     * @test
     */
    public function invalidStarRatingExceptionWhenInvalidValueProvided(): void
    {
        $invalid = '*****';
        $this->expectException(InvalidStarRating::class);
        StarRating::fromEuropeanFormat($invalid);
    }

    /**
     * Number of stars and superior are extracted from the string.
     *
     * @param string $string
     *   The star rating string.
     * @param int $numberOfStars
     *   The expected number of stars.
     * @param bool $isSuperior
     *   The expected is superior value.
     *
     * @dataProvider starRatingStringDataProvider
     *
     * @test
     */
    public function numberOfStarsAndSuperiorAreExtractedFromString($string, $numberOfStars, $isSuperior): void
    {
        $starRating = StarRating::fromEuropeanFormat($string);
        $this->assertSame($numberOfStars, $starRating->getNumberOfStars());
        $this->assertSame($isSuperior, $starRating->isSuperior());
    }

    /**
     * Star rating string data provider.
     *
     * @return array
     *   - string : The star rating string.
     *   - int : The expected number of stars.
     *   - bool : Is the rating superior class.
     */
    public function starRatingStringDataProvider(): array
    {
        return [
            ['1 *', 1, false],
            ['5 * sup', 5, true],
        ];
    }

    /**
     * Not equal if not the same number of stars.
     *
     * @test
     */
    public function valuesNotSameIfDifferentAmountOfStars(): void
    {
        $fiveStars = StarRating::fromEuropeanFormat('5 *');
        $fourStars = StarRating::fromEuropeanFormat('4 *');

        $this->assertFalse($fiveStars->sameValueAs($fourStars));
    }

    /**
     * Not equal if not both same superior rating.
     *
     * @test
     */
    public function valuesNotSameIfDifferentSuperiorRating(): void
    {
        $fiveStar = StarRating::fromEuropeanFormat('5 *');
        $fiveStarSuperiour = StarRating::fromEuropeanFormat('5 * sup');

        $this->assertFalse($fiveStar->sameValueAs($fiveStarSuperiour));
    }

    /**
     * The string value is in European Hotelstar's Union format.
     *
     * @test
     */
    public function castToStringReturnsEuropeanHotelstarsUnionFormat(): void
    {
        $fiveStar = StarRating::fromEuropeanFormat('5 *');
        $this->assertEquals('5 *', (string) $fiveStar);

        $fiveStarSuperiour = StarRating::fromEuropeanFormat('5 * sup');
        $this->assertEquals('5 * sup', (string) $fiveStarSuperiour);
    }
}
