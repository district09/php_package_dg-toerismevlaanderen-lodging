<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Serializer\AddressArraySerializer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Serializer\AddressArraySerializer
 */
class AddressArraySerializerTest extends TestCase
{
    /**
     * Array contains all address information.
     *
     * @test
     */
    public function addressArrayContainsAllData(): void
    {
        $address = Address::fromDetails(
            'Foo street',
            '8',
            'b',
            '9000',
            'Foo locality',
            Coordinates::fromLongitudeLatitude(1.234, 56.789)
        );

        $expectedArray = [
            'street' => 'Foo street',
            'houseNumber' => '8',
            'busNumber' => 'b',
            'postalCode' => '9000',
            'locality' => 'Foo locality',
            'coordinates' => [
                'longitude' => 1.234,
                'latitude' => 56.789,
            ]
        ];

        $serializer = new AddressArraySerializer();
        $this->assertEquals($expectedArray, $serializer->serialize($address));
    }
}
