<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo
 */
class ContactInfoTest extends TestCase
{
    /**
     * Contact is created from its details.
     *
     * @test
     */
    public function contactIsCreatedFromDetails(): void
    {
        $phoneNumbers = PhoneNumbers::fromPhoneNumbers();
        $emailAddresses = EmailAddresses::fromEmailAddresses();
        $websiteAddresses = WebsiteAddresses::fromWebsiteAddresses();

        $contactInfo = ContactInfo::fromDetails($phoneNumbers, $emailAddresses, $websiteAddresses);
        $this->assertEquals($phoneNumbers, $contactInfo->getPhoneNumbers());
        $this->assertEquals($emailAddresses, $contactInfo->getEmailAddresses());
        $this->assertEquals($websiteAddresses, $contactInfo->getWebsiteAddresses());
    }

    /**
     * Not the same value if phone numbers are different.
     *
     * @test
     */
    public function notSameValueIfPhoneNumberIsDifferent(): void
    {
        $phoneNumbers = PhoneNumbers::fromPhoneNumbers();
        $emailAddresses = EmailAddresses::fromEmailAddresses();
        $websiteAddresses = WebsiteAddresses::fromWebsiteAddresses();
        $contactInfo = ContactInfo::fromDetails($phoneNumbers, $emailAddresses, $websiteAddresses);

        $otherPhoneNumbers = PhoneNumbers::fromPhoneNumbers(
            PhoneNumber::fromNumber('+32 9 123 12 12')
        );
        $otherContactInfo = ContactInfo::fromDetails($otherPhoneNumbers, $emailAddresses, $websiteAddresses);

        $this->assertFalse($contactInfo->sameValueAs($otherContactInfo));
    }

    /**
     * Not the same value if email address is different.
     *
     * @test
     */
    public function notSameValueIfEmailAddressIsDifferent(): void
    {
        $phoneNumbers = PhoneNumbers::fromPhoneNumbers();
        $emailAddresses = EmailAddresses::fromEmailAddresses();
        $websiteAddresses = WebsiteAddresses::fromWebsiteAddresses();
        $contactInfo = ContactInfo::fromDetails($phoneNumbers, $emailAddresses, $websiteAddresses);

        $otherEmailAddresses = EmailAddresses::fromEmailAddresses(
            EmailAddress::fromAddress('jane@biz.baz')
        );
        $otherContactInfo = ContactInfo::fromDetails($phoneNumbers, $otherEmailAddresses, $websiteAddresses);

        $this->assertFalse($contactInfo->sameValueAs($otherContactInfo));
    }

    /**
     * Not the same value if website address is different.
     *
     * @test
     */
    public function notSameValueIfWebsiteAddressIsDifferent(): void
    {
        $phoneNumbers = PhoneNumbers::fromPhoneNumbers();
        $emailAddresses = EmailAddresses::fromEmailAddresses();
        $websiteAddresses = WebsiteAddresses::fromWebsiteAddresses();
        $contactInfo = ContactInfo::fromDetails($phoneNumbers, $emailAddresses, $websiteAddresses);

        $otherWebsiteAddresses = WebsiteAddresses::fromWebsiteAddresses(
            WebsiteAddress::fromUrl('https://foo.bar')
        );
        $otherContactInfo = ContactInfo::fromDetails($phoneNumbers, $emailAddresses, $otherWebsiteAddresses);

        $this->assertFalse($contactInfo->sameValueAs($otherContactInfo));
    }

    /**
     * Same values if they share the same details.
     *
     * @test
     */
    public function sameValueIfDetailsAreTheSame(): void
    {
        $phoneNumbers = PhoneNumbers::fromPhoneNumbers();
        $emailAddresses = EmailAddresses::fromEmailAddresses();
        $websiteAddresses = WebsiteAddresses::fromWebsiteAddresses();
        $contactInfo = ContactInfo::fromDetails($phoneNumbers, $emailAddresses, $websiteAddresses);

        $sameContactInfo = ContactInfo::fromDetails($phoneNumbers, $emailAddresses, $websiteAddresses);

        $this->assertTrue($contactInfo->sameValueAs($sameContactInfo));
    }

    /**
     * String version contains the details.
     *
     * @test
     */
    public function castToStringReturnsAddress(): void
    {
        $phoneNumbers = PhoneNumbers::fromPhoneNumbers(
            PhoneNumber::fromNumber('+32 9 123 12 12')
        );
        $emailAddresses = EmailAddresses::fromEmailAddresses(
            EmailAddress::fromAddress('jane@biz.baz')
        );
        $websiteAddresses = WebsiteAddresses::fromWebsiteAddresses(
            WebsiteAddress::fromUrl('http://foo.bar')
        );
        $contactInfo = ContactInfo::fromDetails($phoneNumbers, $emailAddresses, $websiteAddresses);

        $expected = <<<EOT
t: +32 9 123 12 12
m: jane@biz.baz
w: http://foo.bar
EOT;

        $this->assertSame($expected, (string) $contactInfo);
    }
}
