<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Serializer\ContactInfoArraySerializer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses;
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
            PhoneNumbers::fromPhoneNumbers(
                PhoneNumber::fromNumber('+32 9 123 12 12')
            ),
            EmailAddresses::fromEmailAddresses(
                EmailAddress::fromAddress('info@biz.baz')
            ),
            WebsiteAddresses::fromWebsiteAddresses(
                WebsiteAddress::fromUrl('https://foo.baz')
            )
        );

        $expectedArray = [
            'phoneNumbers' => ['+32 9 123 12 12'],
            'emailAddresses' => ['info@biz.baz'],
            'websiteAddresses' => ['https://foo.baz'],
        ];

        $serializer = new ContactInfoArraySerializer();
        $this->assertEquals($expectedArray, $serializer->serialize($contactInfo));
    }
}
