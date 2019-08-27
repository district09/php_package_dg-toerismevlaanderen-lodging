<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Contact;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\Contact
 */
class ContactTest extends TestCase
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

        $contact = Contact::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);
        $this->assertEquals($address, $contact->getAddress());
        $this->assertEquals($phoneNumber, $contact->getPhoneNumber());
        $this->assertEquals($emailAddress, $contact->getEmailAddress());
        $this->assertEquals($websiteAddress, $contact->getWebsiteAddress());
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
        $contact = Contact::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $otherAddress = Address::fromDetails('Foo', 2, 'a', '9000', 'Bar');
        $otherContact = Contact::fromDetails($otherAddress, $phoneNumber, $emailAddress, $websiteAddress);

        $this->assertFalse($contact->sameValueAs($otherContact));
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
        $contact = Contact::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $otherPhoneNumber = PhoneNumber::withoutNumber();
        $otherContact = Contact::fromDetails($address, $otherPhoneNumber, $emailAddress, $websiteAddress);

        $this->assertFalse($contact->sameValueAs($otherContact));
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
        $contact = Contact::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $otherEmailAddress = EmailAddress::withoutAddress();
        $otherContact = Contact::fromDetails($address, $phoneNumber, $otherEmailAddress, $websiteAddress);

        $this->assertFalse($contact->sameValueAs($otherContact));
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
        $contact = Contact::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $otherWebsiteAddress = WebsiteAddress::withoutUrl();
        $otherContact = Contact::fromDetails($address, $phoneNumber, $emailAddress, $otherWebsiteAddress);

        $this->assertFalse($contact->sameValueAs($otherContact));
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
        $contact = Contact::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $sameContact = Contact::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $this->assertTrue($contact->sameValueAs($sameContact));
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
        $contact = Contact::fromDetails($address, $phoneNumber, $emailAddress, $websiteAddress);

        $expected = <<<EOT
Foo 1 a, 9000 Bar
t: +32 9 123 12 12
m: foo@biz.baz
w: http://foo.bar
EOT;

        $this->assertSame($expected, (string) $contact);
    }
}
