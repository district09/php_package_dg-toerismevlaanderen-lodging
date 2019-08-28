<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\AddressArrayNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\AddressArrayNormalizer
 */
class AddressArrayNormalizerTest extends TestCase
{
    /**
     * Address can be created from array without address data.
     *
     * @test
     */
    public function addressCanBeNormalizedFromEmptyDataSet(): void
    {
        $expectedAddress = Address::fromDetails('', '', '', '', '');

        $normalizer = new AddressArrayNormalizer();
        $this->assertEquals($expectedAddress, $normalizer->normalize([]));
    }

    /**
     * All address data is normalized.
     *
     * @test
     */
    public function allAddressDataIsNormalized(): void
    {
        $data = [
            'street' => 'Foo street',
            'houseNumber' => '8',
            'busNumber' => 'b',
            'postalCode' => '9000',
            'locality' => 'Foo locality',
        ];

        $expectedAddress = Address::fromDetails('Foo street', '8', 'b', '9000', 'Foo locality');

        $normalizer = new AddressArrayNormalizer();
        $this->assertEquals($expectedAddress, $normalizer->normalize($data));
    }
}
