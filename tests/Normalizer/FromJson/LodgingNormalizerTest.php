<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\LodgingNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Image;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Images;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\LodgingNormalizer
 */
class LodgingNormalizerTest extends TestCase
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
          "value": "1.234",
          "type": "typed-literal",
          "datatype": "http://www.w3.org/2001/XMLSchema#float"
        },
        "receptionAddress_latitude": {
          "value": "56.789",
          "type": "typed-literal",
          "datatype": "http://www.w3.org/2001/XMLSchema#float"
        },
        "contactPoint_phoneNumbers": {
          "value": "+32 9 123 12 12",
          "type": "literal"
        },
        "contactPoint_emailAddresses": {
          "value": "info@foo.baz",
          "type": "literal"
        },
        "contactPoint_websiteAddresses": {
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
            Address::fromDetails('', '', '', '', '', Coordinates::fromLongitudeLatitude(0, 0)),
            ContactInfo::fromDetails(
                PhoneNumbers::fromPhoneNumbers(),
                EmailAddresses::fromEmailAddresses(),
                WebsiteAddresses::fromWebsiteAddresses()
            ),
            StarRating::fromEuropeanFormat('3 *'),
            QualityLabels::fromLabels(),
            Images::fromImages()
        );

        $normalizer = new LodgingNormalizer();
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
            Address::fromDetails('Foo street', '8', 'b', '9000', 'Foo locality', Coordinates::fromLongitudeLatitude(1.234, 56.789)),
            ContactInfo::fromDetails(
                PhoneNumbers::fromPhoneNumbers(
                    PhoneNumber::fromNumber('+32 9 123 12 12')
                ),
                EmailAddresses::fromEmailAddresses(
                    EmailAddress::fromAddress('info@foo.baz')
                ),
                WebsiteAddresses::fromWebsiteAddresses(
                    WebsiteAddress::fromUrl('https://foo.baz')
                )
            ),
            StarRating::fromEuropeanFormat('4 *'),
            QualityLabels::fromLabels('Label 1', 'Label 2'),
            Images::fromImages(
                Image::fromUrl('http://foo.bar/img/1.jpg'),
                Image::fromUrl('http://foo.bar/img/2.jpg')
            )
        );

        $normalizer = new LodgingNormalizer();
        $this->assertEquals($expectedLodging, $normalizer->normalize($this->completeJson));
    }
}
