<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\QualityLabelsNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\QualityLabelsNormalizer
 */
class QualityLabelsNormalizerTest extends TestCase
{
    /**
     * Partial (minimum data) JSON data.
     *
     * @var string
     */
    private $partialJson = <<<EOT
{
  "results": {
    "bindings": [
      {}
    ]
  }
}
EOT;

    /**
     * Full JSON data.
     *
     * @var string
     */
    private $completeJson = <<<EOT
{
  "results": {
    "bindings": [
      {
        "qualityLabels": {
          "value": "Label 1,Label 2",
          "type": "literal"
        }
      }
    ]
  }
}
EOT;

    /**
     * Lodging can be normalized from minimal data set.
     *
     * @test
     */
    public function lodgingCanBeNormalizedFromMinimalDataSet(): void
    {
        $expectedQualityLabels = QualityLabels::fromLabels();

        $jsonData = json_decode($this->partialJson)->results->bindings[0];

        $normalizer = new QualityLabelsNormalizer();
        $this->assertEquals(
            $expectedQualityLabels,
            $normalizer->normalize($jsonData)
        );
    }

    /**
     * All lodging data is normalized.
     *
     * @test
     */
    public function allLodgingDataIsNormalized(): void
    {
        $expectedQualityLabels = QualityLabels::fromLabels('Label 1', 'Label 2');

        $jsonData = json_decode($this->completeJson)->results->bindings[0];

        $normalizer = new QualityLabelsNormalizer();
        $this->assertEquals(
            $expectedQualityLabels,
            $normalizer->normalize($jsonData)
        );
    }
}
