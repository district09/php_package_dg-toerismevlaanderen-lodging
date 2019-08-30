<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\AddressNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\AddressNormalizer
 */
class AddressNormalizerTest extends TestCase
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
        "receptionAddress_street": {
          "value": "Foo street",
          "type": "literal"
        },
        "receptionAddress_houseNumber": {
          "value": "8",
          "type": "literal"
        },
        "receptionAddress_busNumber": {
          "value": "b",
          "type": "literal"
        },
        "receptionAddress_postalCode": {
          "value": "9000",
          "type": "literal"
        },
        "receptionAddress_locality": {
          "xml:lang": "nl",
          "value": "Foo locality",
          "type": "literal"
        },
        "receptionAddress_longitude": {
          "value": "1.234",
          "type": "typed-literal",
          "datatype": "http://www.w3.org/2001/XMLSchema#float"
        },
        "receptionAddress_latitude": {
          "value": "56.789",
          "type": "typed-literal",
          "datatype": "http://www.w3.org/2001/XMLSchema#float"
        }
      }
    ]
  }
}
EOT;

    /**
     * Address can be normalized from minimal data set.
     *
     * @test
     */
    public function addressCanBeNormalizedFromMinimalDataSet(): void
    {
        $expectedAddress = Address::fromDetails(
            '',
            '',
            '',
            '',
            '',
            Coordinates::fromLongitudeLatitude(0, 0)
        );

        $jsonData = json_decode($this->partialJson)->results->bindings[0];

        $normalizer = new AddressNormalizer();
        $this->assertEquals(
            $expectedAddress,
            $normalizer->normalize($jsonData, 'receptionAddress')
        );
    }

    /**
     * All address data is normalized.
     *
     * @test
     */
    public function allLodgingDataIsNormalized(): void
    {
        $expectedAddress = Address::fromDetails(
            'Foo street',
            '8',
            'b',
            '9000',
            'Foo locality',
            Coordinates::fromLongitudeLatitude(1.234, 56.789)
        );

        $jsonData = json_decode($this->completeJson)->results->bindings[0];

        $normalizer = new AddressNormalizer();
        $this->assertEquals(
            $expectedAddress,
            $normalizer->normalize($jsonData, 'receptionAddress')
        );
    }
}
