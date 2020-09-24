<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Exception;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating
 */
class InvalidRatingTest extends TestCase
{
    /**
     * Proper message is set when created from unknown type.
     *
     * @test
     */
    public function exceptionFromUnknownType(): void
    {
        $exception = InvalidRating::unknownType('Foo * Bar');
        self::assertEquals(
            '"Foo * Bar" rating value is of an unknown type.',
            $exception->getMessage()
        );
        self::assertSame(400, $exception->getCode());
    }

    /**
     * Proper message is set when created from invalid classification value.
     *
     * @test
     */
    public function exceptionFromInvalidClassification(): void
    {
        $exception = InvalidRating::classificationUnknown('Foo Bar');
        self::assertEquals(
            '"Foo Bar" classification value is not within the known types.',
            $exception->getMessage()
        );
        self::assertSame(400, $exception->getCode());
    }

    /**
     * Proper message is set when created from invalid star rating value.
     *
     * @test
     */
    public function exceptionFromInvalidStarRatingFormat(): void
    {
        $exception = InvalidRating::starRatingNotInEuropeanFormat('*****');
        self::assertEquals(
            '"*****" star rating value is not in the European Hotelstar\'s Union format.',
            $exception->getMessage()
        );
        self::assertSame(400, $exception->getCode());
    }

    /**
     * Proper message is set when created from invalid letter rating value.
     *
     * @test
     */
    public function itCreatesExceptionFromInvalidLetterRatingValue(): void
    {
        $exception = InvalidRating::noLetter('1');
        self::assertEquals(
            '"1" is not a valid letter rating value.',
            $exception->getMessage()
        );
        self::assertSame(400, $exception->getCode());
    }
}
