<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Serializer\LodgingArraySerializer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Image;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Images;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Serializer\LodgingArraySerializer
 */
class LodgingArraySerializerTest extends TestCase
{
    /**
     * Array contains all lodging details.
     *
     * @test
     */
    public function addressArrayContainsAllData(): void
    {
        $lodging = Lodging::fromDetails(
            LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999'),
            'Foo name',
            'Foo description',
            55,
            Registration::fromTypeAndStatus('B&B', 'Erkend'),
            Address::fromDetails('Foo street', '8', 'b', '9000', 'Foo locality', Coordinates::fromLongitudeLatitude(1.234, 56.789)),
            ContactInfo::fromDetails(
                PhoneNumber::fromNumber('+32 9 123 12 12'),
                EmailAddress::fromAddress('info@biz.baz'),
                WebsiteAddress::fromUrl('https://foo.baz')
            ),
            StarRating::fromEuropeanFormat('4 *'),
            QualityLabels::fromLabels('label 1', 'Label 2'),
            Images::fromImages(
                Image::fromUrl('http://foo.bar/image/1.jpg'),
                Image::fromUrl('http://foo.bar/image/2.jpg')
            )
        );

        $expectedArray = [
            'lodgingId' => 'http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999',
            'name' => 'Foo name',
            'description' => 'Foo description',
            'numberOfSleepingPlaces' => 55,
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
                    'longitude' => 1.234,
                    'latitude' => 56.789,
                ]
            ],
            'contactPoint' => [
                'phoneNumber' => '+32 9 123 12 12',
                'emailAddress' => 'info@biz.baz',
                'websiteAddress' => 'https://foo.baz',
            ],
            'starRating' => '4 *',
            'qualityLabels' => ['label 1', 'Label 2'],
            'images' => [
                'http://foo.bar/image/1.jpg',
                'http://foo.bar/image/2.jpg',
            ]
        ];

        $serializer = new LodgingArraySerializer();
        $this->assertEquals($expectedArray, $serializer->serialize($lodging));
    }
}
