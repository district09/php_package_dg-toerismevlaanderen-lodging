<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\ContactInfoNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\ContactInfoNormalizer
 */
class ContactInfoNormalizerTest extends TestCase
{
    /**
     * Partial (minimum data) JSON data.
     *
     * @var string
     */
    private $partialJson = <<<EOT
{
  "results": {
    "bindings": [
      {}
    ]
  }
}
EOT;

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
        "contactPoint_phoneNumber": {
          "value": "+32 9 123 12 12",
          "type": "literal"
        },
        "contactPoint_emailAddress": {
          "value": "info@foo.baz",
          "type": "literal"
        },
        "contactPoint_websiteAddress": {
          "value": "https://foo.baz",
          "type": "uri"
        }
      }
    ]
  }
}
EOT;

    /**
     * Contact info can be normalized from minimal data set.
     *
     * @test
     */
    public function contactInfoCanBeNormalizedFromMinimalDataSet(): void
    {
        $expectedContactInfo = ContactInfo::fromDetails(
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
        );

        $jsonData = json_decode($this->partialJson)->results->bindings[0];

        $normalizer = new ContactInfoNormalizer();
        $this->assertEquals(
            $expectedContactInfo,
            $normalizer->normalize($jsonData, 'contactPoint')
        );
    }

    /**
     * All lodging data is normalized.
     *
     * @test
     */
    public function allLodgingDataIsNormalized(): void
    {
        $expectedContactInfo = ContactInfo::fromDetails(
            PhoneNumber::fromNumber('+32 9 123 12 12'),
            EmailAddress::fromAddress('info@foo.baz'),
            WebsiteAddress::fromUrl('https://foo.baz')
        );

        $jsonData = json_decode($this->completeJson)->results->bindings[0];

        $normalizer = new ContactInfoNormalizer();
        $this->assertEquals(
            $expectedContactInfo,
            $normalizer->normalize($jsonData, 'contactPoint')
        );
    }
}
