<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray\ContactInfoNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray\ContactInfoNormalizer
 */
class ContactInfoNormalizerTest extends TestCase
{
    /**
     * Contactpoint can be created from array not containing any data.
     *
     * @test
     */
    public function contactPointCanBeNormalizedFromEmptyDataSet(): void
    {
        $expectedContactPoint = ContactInfo::fromDetails(
            PhoneNumbers::fromPhoneNumbers(),
            EmailAddresses::fromEmailAddresses(),
            WebsiteAddresses::fromWebsiteAddresses()
        );

        $normalizer = new ContactInfoNormalizer();
        $this->assertEquals(
            $expectedContactPoint,
            $normalizer->normalize([])
        );
    }

    /**
     * All contact point data is normalized.
     *
     * @test
     */
    public function allContactPointDataIsNormalized(): void
    {
        $data = [
            // Invalid phone numbers are ignored.
            'phoneNumbers' => ['+32 9 123 12 12'],
            'emailAddresses' => ['foo@biz.baz'],
            'websiteAddresses' => ['https://foo.baz'],
        ];

        $expectedContactPoint = ContactInfo::fromDetails(
            PhoneNumbers::fromPhoneNumbers(
                PhoneNumber::fromNumber('+32 9 123 12 12')
            ),
            EmailAddresses::fromEmailAddresses(
                EmailAddress::fromAddress('foo@biz.baz')
            ),
            WebsiteAddresses::fromWebsiteAddresses(
                WebsiteAddress::fromUrl('https://foo.baz')
            )
        );

        $normalizer = new ContactInfoNormalizer();
        $this->assertEquals($expectedContactPoint, $normalizer->normalize($data));
    }
}
