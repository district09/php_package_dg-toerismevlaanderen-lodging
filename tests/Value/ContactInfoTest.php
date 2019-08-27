<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
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
        $address = Address::fromDetails('Foo', 1, 'a', '9000', 'Bar');
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');

        $contactInfo = ContactInfo::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);
        $this->assertEquals($address, $contactInfo->getAddress());
        $this->assertEquals($phoneNumber, $contactInfo->getPhoneNumber());
        $this->assertEquals($emailAddress, $contactInfo->getEmailAddress());
        $this->assertEquals($websiteAddress, $contactInfo->getWebsiteAddress());
    }

    /**
     * Not the same value if address is different.
     *
     * @test
     */
    public function notSameValueIfAddressIsDifferent(): void
    {
        $address = Address::fromDetails('Foo', 1, 'a', '9000', 'Bar');
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');
        $contactInfo = ContactInfo::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $otherAddress = Address::fromDetails('Foo', 2, 'a', '9000', 'Bar');
        $otherContactInfo = ContactInfo::fromDetails($otherAddress, $phoneNumber, $emailAddress, $websiteAddress);

        $this->assertFalse($contactInfo->sameValueAs($otherContactInfo));
    }

    /**
     * Not the same value if phone number is different.
     *
     * @test
     */
    public function notSameValueIfPhoneNumberIsDifferent(): void
    {
        $address = Address::fromDetails('Foo', 1, 'a', '9000', 'Bar');
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');
        $contactInfo = ContactInfo::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $otherPhoneNumber = PhoneNumber::withoutNumber();
        $otherContactInfo = ContactInfo::fromDetails($address, $otherPhoneNumber, $emailAddress, $websiteAddress);

        $this->assertFalse($contactInfo->sameValueAs($otherContactInfo));
    }

    /**
     * Not the same value if email address is different.
     *
     * @test
     */
    public function notSameValueIfEmailAddressIsDifferent(): void
    {
        $address = Address::fromDetails('Foo', 1, 'a', '9000', 'Bar');
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');
        $contactInfo = ContactInfo::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $otherEmailAddress = EmailAddress::withoutAddress();
        $otherContactInfo = ContactInfo::fromDetails($address, $phoneNumber, $otherEmailAddress, $websiteAddress);

        $this->assertFalse($contactInfo->sameValueAs($otherContactInfo));
    }

    /**
     * Not the same value if website address is different.
     *
     * @test
     */
    public function notSameValueIfWebsiteAddressIsDifferent(): void
    {
        $address = Address::fromDetails('Foo', 1, 'a', '9000', 'Bar');
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');
        $contactInfo = ContactInfo::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $otherWebsiteAddress = WebsiteAddress::withoutUrl();
        $otherContactInfo = ContactInfo::fromDetails($address, $phoneNumber, $emailAddress, $otherWebsiteAddress);

        $this->assertFalse($contactInfo->sameValueAs($otherContactInfo));
    }

    /**
     * Same values if they share the same details.
     *
     * @test
     */
    public function sameValueIfDetailsAreTheSame(): void
    {
        $address = Address::fromDetails('Foo', 1, 'a', '9000', 'Bar');
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');
        $contactInfo = ContactInfo::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $sameContactInfo = ContactInfo::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $this->assertTrue($contactInfo->sameValueAs($sameContactInfo));
    }

    /**
     * String version contains the details.
     *
     * @test
     */
    public function castToStringReturnsAddress(): void
    {
        $address = Address::fromDetails('Foo', 1, 'a', '9000', 'Bar');
        $phoneNumber = PhoneNumber::fromNumber('+32 9 123 12 12');
        $emailAddress = EmailAddress::fromAddress('foo@biz.baz');
        $websiteAddress = WebsiteAddress::fromUrl('http://foo.bar');
        $contactInfo = ContactInfo::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $expected = <<<EOT
Foo 1 a, 9000 Bar
t: +32 9 123 12 12
m: foo@biz.baz
w: http://foo.bar
EOT;

        $this->assertSame($expected, (string) $contactInfo);
    }
}
