<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\NoRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\RatingInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\NoRating
 */
class NoRatingTest extends TestCase
{
    use ProphecyTrait;

    /**
     * No rating has empty value.
     *
     * @test
     */
    public function ratingHasEmptyStringAsValue(): void
    {
        $noRating = NoRating::create();
        $this->assertSame('', $noRating->getRating());
    }

    /**
     * Not equal if not both noRating values.
     *
     * @test
     */
    public function valuesNotSameIfDifferentRatingTypes(): void
    {
        $noRating = NoRating::create();
        $notNoRating = $this->prophesize(RatingInterface::class)->reveal();

        $this->assertFalse($noRating->sameValueAs($notNoRating));
    }

    /**
     * Equal if both have same classification.
     *
     * @test
     */
    public function valuesSameIfSameClassification(): void
    {
        $noRating = NoRating::create();
        $sameRating = NoRating::create();

        $this->assertTrue($noRating->sameValueAs($sameRating));
    }

    /**
     * The string value is the classification value.
     *
     * @test
     */
    public function castToStringReturnsEmptyString(): void
    {
        $this->assertSame('', (string) NoRating::create());
    }
}
