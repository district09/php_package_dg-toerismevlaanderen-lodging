<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ClassificationRating;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\ClassificationRating
 */
class ClassificationRatingTest extends TestCase
{
    /**
     * Exception thrown when provided classification is unknown.
     *
     * The rating should be:
     * - Basic
     * - Comfort
     * - Luxe
     *
     * @test
     */
    public function invalidClassificationRatingExceptionWhenInvalidValueProvided(): void
    {
        $this->expectException(InvalidRating::class);
        ClassificationRating::fromClassification('Foo Bar');
    }

    /**
     * Classification rating based on the provided value.
     *
     * @param string $classification
     *
     * @dataProvider classificationRatingStringDataProvider
     *
     * @test
     */
    public function ratingBasedOnGivenClassification(string $classification): void
    {
        $classificationRating = ClassificationRating::fromClassification($classification);
        $this->assertEquals($classification, $classificationRating->getRating());
    }

    /**
     * Star rating string data provider.
     *
     * @return array
     *   - string : The classification rating string.
     */
    public function classificationRatingStringDataProvider(): array
    {
        return [
            ['Basic'],
            ['Comfort'],
            ['Luxe'],
        ];
    }

    /**
     * Not equal if not the same classification.
     *
     * @test
     */
    public function valuesNotSameIfDifferentClassification(): void
    {
        $basicClassification = ClassificationRating::fromClassification(ClassificationRating::BASIC);
        $luxeClassification = ClassificationRating::fromClassification(ClassificationRating::LUXE);

        $this->assertFalse($basicClassification->sameValueAs($luxeClassification));
    }

    /**
     * Equal if both have same classification.
     *
     * @test
     */
    public function valuesSameIfSameClassification(): void
    {
        $basicClassification = ClassificationRating::fromClassification(ClassificationRating::BASIC);
        $sameClassification = ClassificationRating::fromClassification(ClassificationRating::BASIC);

        $this->assertTrue($basicClassification->sameValueAs($sameClassification));
    }

    /**
     * The string value is the classification value.
     *
     * @test
     */
    public function castToStringReturnsClassificationValue(): void
    {
        $basicClassification = ClassificationRating::fromClassification(ClassificationRating::BASIC);
        $this->assertSame(
            ClassificationRating::BASIC,
            (string) $basicClassification
        );
    }
}
