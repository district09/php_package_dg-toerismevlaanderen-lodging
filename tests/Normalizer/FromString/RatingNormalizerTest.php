<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromString;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromString\RatingNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ClassificationRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LetterRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\NoRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\RatingInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromString\RatingNormalizer
 */
class RatingNormalizerTest extends TestCase
{
    /**
     * The normalizer returns proper rating type based on the value.
     *
     * @param null|string $value
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\RatingInterface $expectedRating
     *
     * @dataProvider ratingValueDataProvider
     *
     * @test
     */
    public function properRatingValueBasedOnProvidedValue(?string $value, RatingInterface $expectedRating): void
    {
        $normalizer = new RatingNormalizer();
        $this->assertEquals($expectedRating, $normalizer->normalize($value));
    }

    /**
     * Data provider to test the normalizer.
     *
     * @return array
     *   Data to test with:
     *   - value to normalize.
     *   - expected rating value.
     */
    public function ratingValueDataProvider(): array
    {
        return [
            [null, NoRating::create()],
            ['', NoRating::create()],
            ['2 *', StarRating::fromEuropeanFormat('2 *')],
            [ClassificationRating::LUXE, ClassificationRating::fromClassification(ClassificationRating::LUXE)],
            ['A', LetterRating::fromLetter('A')],
        ];
    }

    /**
     * Exception when the provided value is of unknown rating type.
     *
     * @test
     */
    public function exceptionWhenValueIsOfUnknownType(): void
    {
        $normalizer = new RatingNormalizer();
        $this->expectException(InvalidRating::class);
        $normalizer->normalize('TestInvalidRatingType');
    }
}
