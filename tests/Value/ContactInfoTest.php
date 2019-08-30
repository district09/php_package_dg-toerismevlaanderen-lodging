<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
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
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');

        $contactInfo = ContactInfo::fromDetails($phoneNumber, $emailAddress, $websiteAddress);
        $this->assertEquals($phoneNumber, $contactInfo->getPhoneNumber());
        $this->assertEquals($emailAddress, $contactInfo->getEmailAddress());
        $this->assertEquals($websiteAddress, $contactInfo->getWebsiteAddress());
    }

    /**
     * Not the same value if phone number is different.
     *
     * @test
     */
    public function notSameValueIfPhoneNumberIsDifferent(): void
    {
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');
        $contactInfo = ContactInfo::fromDetails($phoneNumber, $emailAddress, $websiteAddress);

        $otherPhoneNumber = PhoneNumber::withoutNumber();
        $otherContactInfo = ContactInfo::fromDetails($otherPhoneNumber, $emailAddress, $websiteAddress);

        $this->assertFalse($contactInfo->sameValueAs($otherContactInfo));
    }

    /**
     * Not the same value if email address is different.
     *
     * @test
     */
    public function notSameValueIfEmailAddressIsDifferent(): void
    {
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');
        $contactInfo = ContactInfo::fromDetails($phoneNumber, $emailAddress, $websiteAddress);

        $otherEmailAddress = EmailAddress::withoutAddress();
        $otherContactInfo = ContactInfo::fromDetails($phoneNumber, $otherEmailAddress, $websiteAddress);

        $this->assertFalse($contactInfo->sameValueAs($otherContactInfo));
    }

    /**
     * Not the same value if website address is different.
     *
     * @test
     */
    public function notSameValueIfWebsiteAddressIsDifferent(): void
    {
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');
        $contactInfo = ContactInfo::fromDetails($phoneNumber, $emailAddress, $websiteAddress);

        $otherWebsiteAddress = WebsiteAddress::withoutUrl();
        $otherContactInfo = ContactInfo::fromDetails($phoneNumber, $emailAddress, $otherWebsiteAddress);

        $this->assertFalse($contactInfo->sameValueAs($otherContactInfo));
    }

    /**
     * Same values if they share the same details.
     *
     * @test
     */
    public function sameValueIfDetailsAreTheSame(): void
    {
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');
        $contactInfo = ContactInfo::fromDetails($phoneNumber, $emailAddress, $websiteAddress);

        $sameContactInfo = ContactInfo::fromDetails($phoneNumber, $emailAddress, $websiteAddress);

        $this->assertTrue($contactInfo->sameValueAs($sameContactInfo));
    }

    /**
     * String version contains the details.
     *
     * @test
     */
    public function castToStringReturnsAddress(): void
    {
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');
        $contactInfo = ContactInfo::fromDetails($phoneNumber, $emailAddress, $websiteAddress);

        $expected = <<<EOT
t: +32 9 123 12 12
m: foo@biz.baz
w: http://foo.bar
EOT;

        $this->assertSame($expected, (string) $contactInfo);
    }
}
