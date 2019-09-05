<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray\LodgingNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Image;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Images;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\NoRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray\LodgingNormalizer
 */
class LodgingNormalizerTest extends TestCase
{
    /**
     * Lodging can be normalized from minimal data set.
     *
     * @test
     */
    public function lodgingCanBeNormalizedFromMinimalDataSet(): void
    {
        $data = [
            'lodgingId' => 'http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999',
            'name' => 'Foo name',
            'numberOfSleepingPlaces' => 55,
            'registration' => [
                'type' => 'B&B',
                'status' => 'Erkend',
            ]
        ];

        $expectedLodging = Lodging::fromDetails(
            LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999'),
            'Foo name',
            '',
            55,
            Registration::fromTypeAndStatus('B&B', 'Erkend'),
            Address::fromDetails('', '', '', '', '', Coordinates::fromLongitudeLatitude(0, 0)),
            ContactInfo::fromDetails(
                PhoneNumbers::fromPhoneNumbers(),
                EmailAddresses::fromEmailAddresses(),
                WebsiteAddresses::fromWebsiteAddresses()
            ),
            NoRating::create(),
            QualityLabels::fromLabels(),
            Images::fromImages()
        );

        $normalizer = new LodgingNormalizer();
        $this->assertEquals($expectedLodging, $normalizer->normalize($data));
    }

    /**
     * All lodging data is normalized.
     *
     * @test
     */
    public function allLodgingDataIsNormalized(): void
    {
        $data = [
            'lodgingId' => 'http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999',
            'name' => 'Foo name',
            'description' => 'Foo description',
            'numberOfSleepingPlaces' => 55,
            'type' => 'B&B',
            'registration' => [
                'type' => 'B&B',
                'status' => 'Erkend',
            ],
            'receptionAddress' => [
                'street' => 'Foo street',
                'houseNumber' => '8',
                'busNumber' => 'b',
                'postalCode' => '9000',
                'locality' => 'Foo locality',
                'coordinates' => [
                    'longitude' => '1.234',
                    'latitude' => '56.789',
                ],
            ],
            'contactPoint' => [
                'phoneNumbers' => ['+32 9 123 12 12'],
                'emailAddresses' => ['foo@biz.baz'],
                'websiteAddresses' => ['https://foo.baz'],
            ],
            'rating' => '2 *',
            'qualityLabels' => ['Label 1', 'Label 2'],
            'images' => [
                'http://foo.bar/image/1.jpg',
                'http://foo.bar/image/2.jpg',
            ],
        ];

        $expectedLodging = Lodging::fromDetails(
            LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999'),
            'Foo name',
            'Foo description',
            55,
            Registration::fromTypeAndStatus('B&B', 'Erkend'),
            Address::fromDetails('Foo street', '8', 'b', '9000', 'Foo locality', Coordinates::fromLongitudeLatitude(1.234, 56.789)),
            ContactInfo::fromDetails(
                PhoneNumbers::fromPhoneNumbers(
                    PhoneNumber::fromNumber('+32 9 123 12 12')
                ),
                EmailAddresses::fromEmailAddresses(
                    EmailAddress::fromAddress('foo@biz.baz')
                ),
                WebsiteAddresses::fromWebsiteAddresses(
                    WebsiteAddress::fromUrl('https://foo.baz')
                )
            ),
            StarRating::fromEuropeanFormat('2 *'),
            QualityLabels::fromLabels('Label 1', 'Label 2'),
            Images::fromImages(
                Image::fromUrl('http://foo.bar/image/1.jpg'),
                Image::fromUrl('http://foo.bar/image/2.jpg')
            )
        );

        $normalizer = new LodgingNormalizer();
        $this->assertEquals($expectedLodging, $normalizer->normalize($data));
    }
}
