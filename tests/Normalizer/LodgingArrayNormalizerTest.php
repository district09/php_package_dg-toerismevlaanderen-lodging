<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\LodgingArrayNormalizer;
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
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\LodgingArrayNormalizer
 */
class LodgingArrayNormalizerTest extends TestCase
{
    /**
     * Lodging can be normalized from minimal data set.
     *
     * @test
     */
    public function lodgingCanBeNormalizedFromMinimalDataSet(): void
    {
        $data = [
            '_lodging' => 'http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999',
            'name' => 'Foo name',
            'numberOfBeds' => '55',
            'type' => 'B&B',
            'registrationStatus' => 'Erkend',
            'starRating' => '2 *',
        ];

        $expectedLodging = Lodging::fromDetails(
            LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999'),
            'Foo name',
            '',
            55,
            Registration::fromTypeAndStatus('B&B', 'Erkend'),
            ContactInfo::fromDetails(
                Address::fromDetails('', '', '', '', ''),
                PhoneNumber::withoutNumber(),
                EmailAddress::withoutAddress(),
                WebsiteAddress::withoutUrl()
            ),
            StarRating::fromEuropeanFormat('2 *')
        );

        $normalizer = new LodgingArrayNormalizer();
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
            '_lodging' => 'http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999',
            'name' => 'Foo name',
            'description' => 'Foo description',
            'numberOfBeds' => '55',
            'type' => 'B&B',
            'registrationStatus' => 'Erkend',
            'starRating' => '2 *',
            'street' => 'Foo street',
            'houseNumber' => '8',
            'busNumber' => 'b',
            'postalCode' => '9000',
            'locality' => 'Foo locality',
            'phoneNumber' => '+32 9 123 12 12',
            'emailAddress' => 'foo@biz.baz',
            'websiteAddress' => 'https://foo.baz',
        ];

        $expectedLodging = Lodging::fromDetails(
            LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999'),
            'Foo name',
            'Foo description',
            55,
            Registration::fromTypeAndStatus('B&B', 'Erkend'),
            ContactInfo::fromDetails(
                Address::fromDetails('Foo street', '8', 'b', '9000', 'Foo locality'),
                PhoneNumber::fromNumber('+32 9 123 12 12'),
                EmailAddress::fromAddress('foo@biz.baz'),
                WebsiteAddress::fromUrl('https://foo.baz')
            ),
            StarRating::fromEuropeanFormat('2 *')
        );

        $normalizer = new LodgingArrayNormalizer();
        $this->assertEquals($expectedLodging, $normalizer->normalize($data));
    }
}
