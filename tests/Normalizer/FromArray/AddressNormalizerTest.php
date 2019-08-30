<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray\AddressNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray\AddressNormalizer
 */
class AddressNormalizerTest extends TestCase
{
    /**
     * Address can be created from array without address data.
     *
     * @test
     */
    public function addressCanBeNormalizedFromEmptyDataSet(): void
    {
        $expectedAddress = Address::fromDetails('', '', '', '', '', Coordinates::fromLongitudeLatitude(0, 0));

        $normalizer = new AddressNormalizer();
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
            'coordinates' => [
                'longitude' => '1.234',
                'latitude' => '56.789',
            ],
        ];

        $expectedAddress = Address::fromDetails(
            'Foo street',
            '8',
            'b',
            '9000',
            'Foo locality',
            Coordinates::fromLongitudeLatitude(1.234, 56.789)
        );

        $normalizer = new AddressNormalizer();
        $this->assertEquals($expectedAddress, $normalizer->normalize($data));
    }
}
