<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\ContactInfoNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\ContactInfoNormalizer
 */
class ContactInfoNormalizerTest extends TestCase
{
    /**
     * Full JSON data.
     *
     * @var string
     */
    private $completeJson = <<<EOT
{
  "results": {
    "bindings": [
      {
        "contactPoint_phoneNumbers": {
          "value": "+32 9 123 12 12,+32 9 123 12 34",
          "type": "literal"
        },
        "contactPoint_emailAddresses": {
          "value": "jane@foo.baz,john@foo.baz",
          "type": "literal"
        },
        "contactPoint_websiteAddresses": {
          "value": "https://foo.baz,https://foo.bar",
          "type": "uri"
        }
      }
    ]
  }
}
EOT;

    /**
     * All contact point data is normalized.
     *
     * @test
     */
    public function allLodgingDataIsNormalized(): void
    {
        $expectedPhoneNumbers = PhoneNumbers::fromPhoneNumbers(
            PhoneNumber::fromNumber('+32 9 123 12 12'),
            PhoneNumber::fromNumber('+32 9 123 12 34')
        );
        $expectedEmailaddress = EmailAddresses::fromEmailAddresses(
            EmailAddress::fromAddress('jane@foo.baz'),
            EmailAddress::fromAddress('john@foo.baz')
        );
        $expectedWebsiteAddresses = WebsiteAddresses::fromWebsiteAddresses(
            WebsiteAddress::fromUrl('https://foo.baz'),
            WebsiteAddress::fromUrl('https://foo.bar')
        );

        $expectedContactInfo = ContactInfo::fromDetails(
            $expectedPhoneNumbers,
            $expectedEmailaddress,
            $expectedWebsiteAddresses
        );

        $jsonData = json_decode($this->completeJson)->results->bindings[0];

        $normalizer = new ContactInfoNormalizer();
        $this->assertEquals(
            $expectedContactInfo,
            $normalizer->normalize($jsonData, 'contactPoint')
        );
    }
}
