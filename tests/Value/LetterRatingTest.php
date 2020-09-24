<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LetterRating;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\LetterRating
 */
class LetterRatingTest extends TestCase
{
    /**
     * Exception thrown provided letter rating is not in proper format.
     *
     * @test
     */
    public function itThrowsExceptionWhenLetterRatingIsNotValid(): void
    {
        $this->expectException(InvalidRating::class);
        LetterRating::fromLetter('AB');
    }

    /**
     * Rating value is based on given letter.
     *
     * @test
     */
    public function itHasRatingValueBasedOnLetter(): void
    {
        $letterRating = LetterRating::fromLetter('B');
        self::assertEquals('B', $letterRating->getRating());
    }

    /**
     * Not equal if not the same letter.
     *
     * @test
     */
    public function itHasNotSameValueAsOtherWhenLettersAreDifferent(): void
    {
        $rating = LetterRating::fromLetter('A');
        $otherRating = LetterRating::fromLetter('B');

        self::assertFalse($rating->sameValueAs($otherRating));
    }

    /**
     * Equal when both have same letter.
     *
     * @test
     */
    public function itHasSameValueAsOtherWhenLettersAreEqual(): void
    {
        $rating = LetterRating::fromLetter('A');
        $sameRating = LetterRating::fromLetter('A');

        self::assertTrue($rating->sameValueAs($sameRating));
    }

    /**
     * The string value is in European Hotelstar's Union format.
     *
     * @test
     */
    public function itReturnsLetterWhenCastedToString(): void
    {
        $rating = LetterRating::fromLetter('C');
        self::assertSame('C', (string) $rating);
    }
}
