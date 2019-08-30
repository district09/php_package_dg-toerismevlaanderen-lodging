<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray\QualityLabelsNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray\QualityLabelsNormalizer
 */
class QualityLabelsNormalizerTest extends TestCase
{
    /**
     * All quality labels data are normalized.
     *
     * @test
     */
    public function allLodgingDataIsNormalized(): void
    {
        $data = ['Label 1', 'Label 2'];

        $expectedQualityLabels = QualityLabels::fromLabels('Label 1', 'Label 2');

        $normalizer = new QualityLabelsNormalizer();
        $this->assertEquals(
            $expectedQualityLabels,
            $normalizer->normalize($data)
        );
    }
}
