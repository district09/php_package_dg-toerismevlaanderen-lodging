<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Value;

use ArrayIterator;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels
 */
class QualityLabelsTest extends TestCase
{
    /**
     * From labels stores the label strings.
     *
     * @test
     */
    public function fromLabelsStoresTheValues(): void
    {
        $qualityLabels = QualityLabels::fromLabels('Label 1', 'Label 2');
        $this->assertEquals(
            ['Label 1', 'Label 2'],
            $qualityLabels->getLabels()
        );
    }

    /**
     * Get iterator returns the values.
     *
     * @test
     */
    public function getIteratorReturnsArrayInterface(): void
    {
        $qualityLabels = QualityLabels::fromLabels('Label 1', 'Label 2');
        $iterator = $qualityLabels->getIterator();
        $this->assertInstanceOf(ArrayIterator::class, $iterator);
        $this->assertCount(2, $iterator);
    }

    /**
     * Not the same value if the labels are different.
     *
     * @test
     */
    public function notTheSameValueWhenNotTheSameLabels(): void
    {
        $qualityLabels = QualityLabels::fromLabels('Label 1', 'Label 2');
        $otherQualityLabels = QualityLabels::fromLabels('Label 3');
        $this->assertFalse($qualityLabels->sameValueAs($otherQualityLabels));
    }

    /**
     * Same value if the labels are the same (even not in the same order).
     *
     * @test
     */
    public function sameValueIfBothHaveSameLabels(): void
    {
        $qualityLabels = QualityLabels::fromLabels('Label 1', 'Label 2');
        $sameQualityLabels = QualityLabels::fromLabels('Label 2', 'Label 1');
        $this->assertTrue($qualityLabels->sameValueAs($sameQualityLabels));
    }

    /**
     * To string returns the labels separated by a comma.
     *
     * @test
     */
    public function toStringReturnsTheLabels(): void
    {
        $qualityLabels = QualityLabels::fromLabels('Label 1', 'Label 2');
        $this->assertEquals(
            'Label 1, Label 2',
            (string) $qualityLabels
        );
    }
}
