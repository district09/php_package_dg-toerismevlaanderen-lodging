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
        "registration_type": {
          "xml:lang": "nl",
          "value": "B&B",
          "type": "literal"
        },
        "registration_status": {
          "xml:lang": "nl",
          "value": "Foo status",
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
        "numberOfSleepingPlaces": {
          "value": "55",
          "type": "typed-literal",
          "datatype": "http://www.w3.org/2001/XMLSchema#integer"
        },
        "registration_type": {
          "xml:lang": "nl",
          "value": "B&B",
          "type": "literal"
        },
        "registration_status": {
          "xml:lang": "nl",
          "value": "Foo status",
          "type": "literal"
        },
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
          "value": "3.72543",
          "type": "typed-literal",
          "datatype": "http://www.w3.org/2001/XMLSchema#float"
        },
        "receptionAddress_latitude": {
          "value": "51.0547",
          "type": "typed-literal",
          "datatype": "http://www.w3.org/2001/XMLSchema#float"
        },
        "contactPoint_phoneNumber": {
          "value": "+32 9 123 12 12",
          "type": "literal"
        },
        "contactPoint_emailAddress": {
          "value": "info@foo.baz",
          "type": "literal"
        },
        "contactPoint_websiteAddress": {
          "value": "https://foo.baz",
          "type": "uri"
        },
        "starRating": {
          "value": "4 *",
          "type": "literal"
        },
        "qualityLabels": {
          "value": "Label 1,Label 2",
          "type": "literal"
        },
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
            Registration::fromTypeAndStatus('B&B', 'Foo status'),
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
            Registration::fromTypeAndStatus('B&B', 'Foo status'),
            Address::fromDetails('Foo street', '8', 'b', '9000', 'Foo locality'),
            ContactInfo::fromDetails(
                PhoneNumber::fromNumber('+32 9 123 12 12'),
                EmailAddress::fromAddress('info@foo.baz'),
                WebsiteAddress::fromUrl('https://foo.baz')
            ),
            StarRating::fromEuropeanFormat('4 *')
        );

        $normalizer = new LodgingJsonNormalizer();
        $this->assertEquals($expectedLodging, $normalizer->normalize($this->completeJson));
    }
}
