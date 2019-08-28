<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging
 */
class LodgingTest extends TestCase
{
    /**
     * Lodging can be created from its details.
     *
     * @test
     */
    public function valueCanBeCreatedFromItsDetails(): void
    {
        $listId = LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999');
        $name = 'Foo';
        $description = 'Bar';
        $numberOfSleepingPlaces = 15;
        $registration = Registration::fromTypeAndStatus('Biz', 'Baz');
        $contactPoint = ContactInfo::fromDetails(
            Address::fromDetails('Foo', '5', 'b', '9000', 'Baz'),
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
        );
        $starRating = StarRating::fromEuropeanFormat('4 *');

        $lodging = Lodging::fromDetails($listId, $name, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);
        $this->assertSame($listId, $lodging->getLodgingId());
        $this->assertSame($name, $lodging->getName());
        $this->assertSame($description, $lodging->getDescription());
        $this->assertSame($registration, $lodging->getRegistration());
        $this->assertSame($contactPoint, $lodging->getContactPoint());
        $this->assertSame($starRating, $lodging->getStarRating());
    }

    /**
     * Not the same value when different lodging id.
     *
     * @test
     */
    public function notSameValueWhenDifferentId(): void
    {
        $lodgingId = LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999');
        $name = 'Foo';
        $description = 'Bar';
        $numberOfSleepingPlaces = 15;
        $registration = Registration::fromTypeAndStatus('Biz', 'Baz');
        $contactPoint = ContactInfo::fromDetails(
            Address::fromDetails('Foo', '5', 'b', '9000', 'Baz'),
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
        );
        $starRating = StarRating::fromEuropeanFormat('4 *');
        $lodging = Lodging::fromDetails($lodgingId, $name, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $otherLodgingId = LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-888888');
        $otherLodging = Lodging::fromDetails($otherLodgingId, $name, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different name.
     *
     * @test
     */
    public function notSameValueWhenDifferentName(): void
    {
        $lodgingId = LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999');
        $name = 'Foo';
        $description = 'Bar';
        $numberOfSleepingPlaces = 15;
        $registration = Registration::fromTypeAndStatus('Biz', 'Baz');
        $contactPoint = ContactInfo::fromDetails(
            Address::fromDetails('Foo', '5', 'b', '9000', 'Baz'),
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
        );
        $starRating = StarRating::fromEuropeanFormat('4 *');
        $lodging = Lodging::fromDetails($lodgingId, $name, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $otherName = 'Fiz';
        $otherLodging = Lodging::fromDetails($lodgingId, $otherName, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different description.
     *
     * @test
     */
    public function notSameValueWhenDifferentDescription(): void
    {
        $lodgingId = LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999');
        $name = 'Foo';
        $description = 'Bar';
        $numberOfSleepingPlaces = 15;
        $registration = Registration::fromTypeAndStatus('Biz', 'Baz');
        $contactPoint = ContactInfo::fromDetails(
            Address::fromDetails('Foo', '5', 'b', '9000', 'Baz'),
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
        );
        $starRating = StarRating::fromEuropeanFormat('4 *');
        $lodging = Lodging::fromDetails($lodgingId, $name, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $otherDescription = 'Fiz';
        $otherLodging = Lodging::fromDetails($lodgingId, $name, $otherDescription, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different number of sleeping places.
     *
     * @test
     */
    public function notSameValueWhenDifferentNumberOfSleepingPlaces(): void
    {
        $lodgingId = LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999');
        $name = 'Foo';
        $description = 'Bar';
        $numberOfSleepingPlaces = 15;
        $registration = Registration::fromTypeAndStatus('Biz', 'Baz');
        $contactPoint = ContactInfo::fromDetails(
            Address::fromDetails('Foo', '5', 'b', '9000', 'Baz'),
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
        );
        $starRating = StarRating::fromEuropeanFormat('4 *');
        $lodging = Lodging::fromDetails($lodgingId, $name, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $otherNumberOfSleepingPlaces = 16;
        $otherLodging = Lodging::fromDetails($lodgingId, $name, $description, $otherNumberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different registration.
     *
     * @test
     */
    public function notSameValueWhenDifferentRegistration(): void
    {
        $lodgingId = LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999');
        $name = 'Foo';
        $description = 'Bar';
        $numberOfSleepingPlaces = 15;
        $registration = Registration::fromTypeAndStatus('Biz', 'Baz');
        $contactPoint = ContactInfo::fromDetails(
            Address::fromDetails('Foo', '5', 'b', '9000', 'Baz'),
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
        );
        $starRating = StarRating::fromEuropeanFormat('4 *');
        $lodging = Lodging::fromDetails($lodgingId, $name, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $otherRegistration = Registration::fromTypeAndStatus('Fiz', 'Baz');
        $otherLodging = Lodging::fromDetails($lodgingId, $name, $description, $numberOfSleepingPlaces, $otherRegistration, $contactPoint, $starRating);

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different contact point.
     *
     * @test
     */
    public function notSameValueWhenDifferentContactPoint(): void
    {
        $lodgingId = LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999');
        $name = 'Foo';
        $description = 'Bar';
        $numberOfSleepingPlaces = 15;
        $registration = Registration::fromTypeAndStatus('Biz', 'Baz');
        $contactPoint = ContactInfo::fromDetails(
            Address::fromDetails('Foo', '5', 'b', '9000', 'Baz'),
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
        );
        $starRating = StarRating::fromEuropeanFormat('4 *');
        $lodging = Lodging::fromDetails($lodgingId, $name, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $otherContactPoint = ContactInfo::fromDetails(
            Address::fromDetails('Fiz', '5', 'b', '9000', 'Baz'),
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
        );
        $otherLodging = Lodging::fromDetails($lodgingId, $name, $description, $numberOfSleepingPlaces, $registration, $otherContactPoint, $starRating);

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different star rating.
     *
     * @test
     */
    public function notSameValueWhenDifferentStarRating(): void
    {
        $lodgingId = LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999');
        $name = 'Foo';
        $description = 'Bar';
        $numberOfSleepingPlaces = 15;
        $registration = Registration::fromTypeAndStatus('Biz', 'Baz');
        $contactPoint = ContactInfo::fromDetails(
            Address::fromDetails('Foo', '5', 'b', '9000', 'Baz'),
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
        );
        $starRating = StarRating::fromEuropeanFormat('4 *');
        $lodging = Lodging::fromDetails($lodgingId, $name, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $otherStarRating = StarRating::fromEuropeanFormat('1 *');
        $otherLodging = Lodging::fromDetails($lodgingId, $name, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $otherStarRating);

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Same value if details are the same.
     *
     * @test
     */
    public function sameValueIfDetailsAreTheSame(): void
    {
        $lodgingId = LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999');
        $name = 'Foo';
        $description = 'Bar';
        $numberOfSleepingPlaces = 15;
        $registration = Registration::fromTypeAndStatus('Biz', 'Baz');
        $contactPoint = ContactInfo::fromDetails(
            Address::fromDetails('Foo', '5', 'b', '9000', 'Baz'),
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
        );
        $starRating = StarRating::fromEuropeanFormat('4 *');
        $lodging = Lodging::fromDetails($lodgingId, $name, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $sameLodging = Lodging::fromDetails($lodgingId, $name, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $this->assertTrue($lodging->sameValueAs($sameLodging));
    }

    /**
     * String version of the object is the list item name.
     *
     * @test
     */
    public function castToStringReturnsName(): void
    {
        $lodgingId = LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999');
        $name = 'Foo';
        $description = 'Bar';
        $numberOfSleepingPlaces = 15;
        $registration = Registration::fromTypeAndStatus('Biz', 'Baz');
        $contactPoint = ContactInfo::fromDetails(
            Address::fromDetails('Foo', '5', 'b', '9000', 'Baz'),
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
        );
        $starRating = StarRating::fromEuropeanFormat('4 *');

        $lodging = Lodging::fromDetails($lodgingId, $name, $description, $numberOfSleepingPlaces, $registration, $contactPoint, $starRating);

        $this->assertEquals('Foo', (string) $lodging);
    }
}
