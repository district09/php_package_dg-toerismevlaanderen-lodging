<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\ImagesNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Image;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Images;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\ImagesNormalizer
 */
class ImagesNormalizerTest extends TestCase
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
        "images": {
          "value": "http://foo.bar/img/1.jpg,http://foo.bar/img/2.jpg",
          "type": "literal"
        }
      }
    ]
  }
}
EOT;

    /**
     * Images can be normalized from minimal data set.
     *
     * @test
     */
    public function imagesCanBeNormalizedFromMinimalDataSet(): void
    {
        $expectedImages = Images::fromImages();

        $jsonData = json_decode($this->partialJson)->results->bindings[0];

        $normalizer = new ImagesNormalizer();
        $this->assertEquals(
            $expectedImages,
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
        $expectedImages = Images::fromImages(
            Image::fromUrl('http://foo.bar/img/1.jpg'),
            Image::fromUrl('http://foo.bar/img/2.jpg')
        );

        $jsonData = json_decode($this->completeJson)->results->bindings[0];

        $normalizer = new ImagesNormalizer();
        $this->assertEquals(
            $expectedImages,
            $normalizer->normalize($jsonData)
        );
    }
}
