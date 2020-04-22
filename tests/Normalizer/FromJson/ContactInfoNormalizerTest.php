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
          "value": "+32 9 123 00 02,+32 9 123 00 01",
          "type": "literal"
        },
        "contactPoint_emailAddresses": {
          "value": "jane_2@foo.baz,john_1@foo.baz",
          "type": "literal"
        },
        "contactPoint_websiteAddresses": {
          "value": "https://foo.baz/2,https://foo.bar/1",
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
        // Invalid phone numbers are ignored.
        $expectedPhoneNumbers = PhoneNumbers::fromPhoneNumbers(
            PhoneNumber::fromNumber('+32 9 123 00 01'),
            PhoneNumber::fromNumber('+32 9 123 00 02')
        );
        $expectedEmailaddress = EmailAddresses::fromEmailAddresses(
            EmailAddress::fromAddress('john_1@foo.baz'),
            EmailAddress::fromAddress('jane_2@foo.baz')
        );
        $expectedWebsiteAddresses = WebsiteAddresses::fromWebsiteAddresses(
            WebsiteAddress::fromUrl('https://foo.bar/1'),
            WebsiteAddress::fromUrl('https://foo.baz/2')
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
