<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray\ContactInfoNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
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
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
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
            'phoneNumber' => '+32 9 123 12 12',
            'emailAddress' => 'foo@biz.baz',
            'websiteAddress' => 'https://foo.baz',
        ];

        $expectedContactPoint = ContactInfo::fromDetails(
            PhoneNumber::fromNumber('+32 9 123 12 12'),
            EmailAddress::fromAddress('foo@biz.baz'),
            WebsiteAddress::fromUrl('https://foo.baz')
        );

        $normalizer = new ContactInfoNormalizer();
        $this->assertEquals($expectedContactPoint, $normalizer->normalize($data));
    }
}
