<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\LodgingJsonNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\LodgingJsonNormalizer
 */
class LodgingJsonNormalizerTest extends TestCase
{
    /**
     * Partial (minimum data) JSON data.
     *
     * @var string
     */
    private $partialJson = <<<EOT
{
  "results": {
    "ordered": true,
    "distinct": false,
    "bindings": [
      {
        "_lodging": {
          "value": "http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999",
          "type": "uri"
        },
        "name": {
          "xml:lang": "nl",
          "value": "Foo name",
          "type": "literal"
        },
        "type": {
          "xml:lang": "nl",
          "value": "B&B",
          "type": "literal"
        },
        "registrationStatus": {
          "xml:lang": "nl",
          "value": "Erkend",
          "type": "literal"
        },
        "numberOfSleepingPlaces": {
          "value": "55",
          "type": "typed-literal",
          "datatype": "http://www.w3.org/2001/XMLSchema#integer"
        },
        "starRating": {
          "value": "3 *",
          "type": "literal"
        }
      }
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
    "ordered": true,
    "distinct": false,
    "bindings": [
      {
        "_lodging": {
          "value": "http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999",
          "type": "uri"
        },
        "name": {
          "xml:lang": "nl",
          "value": "Foo name",
          "type": "literal"
        },
        "description": {
          "xml:lang": "nl",
          "value": "Foo description",
          "type": "literal"
        },
        "type": {
          "xml:lang": "nl",
          "value": "B&B",
          "type": "literal"
        },
        "registrationStatus": {
          "xml:lang": "nl",
          "value": "Erkend",
          "type": "literal"
        },
        "numberOfSleepingPlaces": {
          "value": "55",
          "type": "typed-literal",
          "datatype": "http://www.w3.org/2001/XMLSchema#integer"
        },
        "street": {
          "value": "Foo street",
          "type": "literal"
        },
        "houseNumber": {
          "value": "138",
          "type": "literal"
        },
        "busNumber": {
          "value": "b",
          "type": "literal"
        },
        "postalCode": {
          "value": "9000",
          "type": "literal"
        },
        "locality": {
          "xml:lang": "nl",
          "value": "Foo locality",
          "type": "literal"
        },
        "phoneNumber": {
          "value": "+32 9 123 12 12",
          "type": "literal"
        },
        "emailAddress": {
          "value": "foo@biz.baz",
          "type": "literal"
        },
        "websiteAddress": {
          "value": "https://foo.bar",
          "type": "uri"
        },
        "starRating": {
          "value": "3 *",
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
        $expectedLodging = Lodging::fromDetails(
            LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999'),
            'Foo name',
            '',
            55,
            Registration::fromTypeAndStatus('B&B', 'Erkend'),
            Address::fromDetails('', '', '', '', ''),
            ContactInfo::fromDetails(
                PhoneNumber::withoutNumber(),
                EmailAddress::withoutAddress(),
                WebsiteAddress::withoutUrl()
            ),
            StarRating::fromEuropeanFormat('3 *')
        );

        $normalizer = new LodgingJsonNormalizer();
        $this->assertEquals($expectedLodging, $normalizer->normalize($this->partialJson));
    }

    /**
     * All lodging data is normalized.
     *
     * @test
     */
    public function allLodgingDataIsNormalized(): void
    {
        $expectedLodging = Lodging::fromDetails(
            LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999'),
            'Foo name',
            'Foo description',
            55,
            Registration::fromTypeAndStatus('B&B', 'Erkend'),
            Address::fromDetails('Foo street', '138', 'b', '9000', 'Foo locality'),
            ContactInfo::fromDetails(
                PhoneNumber::fromNumber('+32 9 123 12 12'),
                EmailAddress::fromAddress('foo@biz.baz'),
                WebsiteAddress::fromUrl('https://foo.bar')
            ),
            StarRating::fromEuropeanFormat('3 *')
        );

        $normalizer = new LodgingJsonNormalizer();
        $this->assertEquals($expectedLodging, $normalizer->normalize($this->completeJson));
    }
}
