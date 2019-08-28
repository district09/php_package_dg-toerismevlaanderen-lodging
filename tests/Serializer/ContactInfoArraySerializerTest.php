<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Serializer\ContactInfoArraySerializer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Serializer\ContactInfoArraySerializer
 */
class ContactInfoArraySerializerTest extends TestCase
{
    /**
     * Array contains all contact info information.
     *
     * @test
     */
    public function addressArrayContainsAllData(): void
    {
        $contactInfo = ContactInfo::fromDetails(
            Address::fromDetails('Foo street', '8', 'b', '9000', 'Foo locality'),
            PhoneNumber::fromNumber('+32 9 123 12 12'),
            EmailAddress::fromAddress('info@biz.baz'),
            WebsiteAddress::fromUrl('https://foo.baz')
        );

        $expectedArray = [
            'address' => [
                'street' => 'Foo street',
                'houseNumber' => '8',
                'busNumber' => 'b',
                'postalCode' => '9000',
                'locality' => 'Foo locality',
            ],
            'phoneNumber' => '+32 9 123 12 12',
            'emailAddress' => 'info@biz.baz',
            'websiteAddress' => 'https://foo.baz',
        ];

        $serializer = new ContactInfoArraySerializer();
        $this->assertEquals($expectedArray, $serializer->serialize($contactInfo));
    }
}
