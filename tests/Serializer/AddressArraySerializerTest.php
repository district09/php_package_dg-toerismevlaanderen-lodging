<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Serializer\AddressArraySerializer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
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
        $address = Address::fromDetails('Foo street', '8', 'b', '9000', 'Foo locality');
        $expectedArray = [
            'street' => 'Foo street',
            'houseNumber' => '8',
            'busNumber' => 'b',
            'postalCode' => '9000',
            'locality' => 'Foo locality',
        ];

        $serializer = new AddressArraySerializer();
        $this->assertEquals($expectedArray, $serializer->serialize($address));
    }
}
