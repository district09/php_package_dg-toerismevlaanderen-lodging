<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Image;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Images;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels;
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
        $receptionAddress = Address::fromDetails('Foo', '5', 'b', '9000', 'Baz', Coordinates::fromLongitudeLatitude(0, 0));
        $contactPoint = ContactInfo::fromDetails(
            PhoneNumber::withoutNumber(),
            EmailAddress::withoutAddress(),
            WebsiteAddress::withoutUrl()
        );
        $starRating = StarRating::fromEuropeanFormat('4 *');
        $qualityLabels = QualityLabels::fromLabels('Label 1', 'Label 2');
        $images = Images::fromImages();

        $lodging = Lodging::fromDetails(
            $listId,
            $name,
            $description,
            $numberOfSleepingPlaces,
            $registration,
            $receptionAddress,
            $contactPoint,
            $starRating,
            $qualityLabels,
            $images
        );
        $this->assertSame($listId, $lodging->getLodgingId());
        $this->assertSame($name, $lodging->getName());
        $this->assertSame($description, $lodging->getDescription());
        $this->assertSame($registration, $lodging->getRegistration());
        $this->assertSame($receptionAddress, $lodging->getReceptionAddress());
        $this->assertSame($contactPoint, $lodging->getContactPoint());
        $this->assertSame($starRating, $lodging->getStarRating());
        $this->assertSame($qualityLabels, $lodging->getQualityLabels());
        $this->assertSame($images, $lodging->getImages());
    }

    /**
     * Not the same value when different lodging id.
     *
     * @test
     */
    public function notSameValueWhenDifferentId(): void
    {
        $lodging = $this->createLodging();
        $otherLodging = Lodging::fromDetails(
            LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-888888'),
            $lodging->getName(),
            $lodging->getDescription(),
            $lodging->getNumberOfSleepingPlaces(),
            $lodging->getRegistration(),
            $lodging->getReceptionAddress(),
            $lodging->getContactPoint(),
            $lodging->getStarRating(),
            $lodging->getQualityLabels(),
            $lodging->getImages()
        );

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different name.
     *
     * @test
     */
    public function notSameValueWhenDifferentName(): void
    {
        $lodging = $this->createLodging();
        $otherLodging = Lodging::fromDetails(
            $lodging->getLodgingId(),
            'Fiz name',
            $lodging->getDescription(),
            $lodging->getNumberOfSleepingPlaces(),
            $lodging->getRegistration(),
            $lodging->getReceptionAddress(),
            $lodging->getContactPoint(),
            $lodging->getStarRating(),
            $lodging->getQualityLabels(),
            $lodging->getImages()
        );

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different description.
     *
     * @test
     */
    public function notSameValueWhenDifferentDescription(): void
    {
        $lodging = $this->createLodging();
        $otherLodging = Lodging::fromDetails(
            $lodging->getLodgingId(),
            $lodging->getName(),
            'Fiz description',
            $lodging->getNumberOfSleepingPlaces(),
            $lodging->getRegistration(),
            $lodging->getReceptionAddress(),
            $lodging->getContactPoint(),
            $lodging->getStarRating(),
            $lodging->getQualityLabels(),
            $lodging->getImages()
        );

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different number of sleeping places.
     *
     * @test
     */
    public function notSameValueWhenDifferentNumberOfSleepingPlaces(): void
    {
        $lodging = $this->createLodging();
        $otherLodging = Lodging::fromDetails(
            $lodging->getLodgingId(),
            $lodging->getName(),
            $lodging->getDescription(),
            16,
            $lodging->getRegistration(),
            $lodging->getReceptionAddress(),
            $lodging->getContactPoint(),
            $lodging->getStarRating(),
            $lodging->getQualityLabels(),
            $lodging->getImages()
        );

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different registration.
     *
     * @test
     */
    public function notSameValueWhenDifferentRegistration(): void
    {
        $lodging = $this->createLodging();
        $otherLodging = Lodging::fromDetails(
            $lodging->getLodgingId(),
            $lodging->getName(),
            $lodging->getDescription(),
            $lodging->getNumberOfSleepingPlaces(),
            Registration::fromTypeAndStatus('Fiz', 'Baz'),
            $lodging->getReceptionAddress(),
            $lodging->getContactPoint(),
            $lodging->getStarRating(),
            $lodging->getQualityLabels(),
            $lodging->getImages()
        );

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different registration.
     *
     * @test
     */
    public function notSameValueWhenDifferentReceptionAddress(): void
    {
        $lodging = $this->createLodging();
        $otherLodging = Lodging::fromDetails(
            $lodging->getLodgingId(),
            $lodging->getName(),
            $lodging->getDescription(),
            $lodging->getNumberOfSleepingPlaces(),
            $lodging->getRegistration(),
            Address::fromDetails('Other address', '5', 'b', '9000', 'Baz', Coordinates::fromLongitudeLatitude(0, 0)),
            $lodging->getContactPoint(),
            $lodging->getStarRating(),
            $lodging->getQualityLabels(),
            $lodging->getImages()
        );

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different contact point.
     *
     * @test
     */
    public function notSameValueWhenDifferentContactPoint(): void
    {
        $lodging = $this->createLodging();
        $otherLodging = Lodging::fromDetails(
            $lodging->getLodgingId(),
            $lodging->getName(),
            $lodging->getDescription(),
            $lodging->getNumberOfSleepingPlaces(),
            $lodging->getRegistration(),
            $lodging->getReceptionAddress(),
            ContactInfo::fromDetails(
                PhoneNumber::withoutNumber(),
                EmailAddress::withoutAddress(),
                WebsiteAddress::withoutUrl()
            ),
            $lodging->getStarRating(),
            $lodging->getQualityLabels(),
            $lodging->getImages()
        );

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different star rating.
     *
     * @test
     */
    public function notSameValueWhenDifferentStarRating(): void
    {
        $lodging = $this->createLodging();
        $otherLodging = Lodging::fromDetails(
            $lodging->getLodgingId(),
            $lodging->getName(),
            $lodging->getDescription(),
            $lodging->getNumberOfSleepingPlaces(),
            $lodging->getRegistration(),
            $lodging->getReceptionAddress(),
            $lodging->getContactPoint(),
            StarRating::fromEuropeanFormat('1 *'),
            $lodging->getQualityLabels(),
            $lodging->getImages()
        );

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different quality labels.
     *
     * @test
     */
    public function notSameValueWhenDifferentQualityLabels(): void
    {
        $lodging = $this->createLodging();
        $otherLodging = Lodging::fromDetails(
            $lodging->getLodgingId(),
            $lodging->getName(),
            $lodging->getDescription(),
            $lodging->getNumberOfSleepingPlaces(),
            $lodging->getRegistration(),
            $lodging->getReceptionAddress(),
            $lodging->getContactPoint(),
            $lodging->getStarRating(),
            QualityLabels::fromLabels('Other label'),
            $lodging->getImages()
        );

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Not the same value when different images.
     *
     * @test
     */
    public function notSameValueWhenDifferentImages(): void
    {
        $lodging = $this->createLodging();
        $otherLodging = Lodging::fromDetails(
            $lodging->getLodgingId(),
            $lodging->getName(),
            $lodging->getDescription(),
            $lodging->getNumberOfSleepingPlaces(),
            $lodging->getRegistration(),
            $lodging->getReceptionAddress(),
            $lodging->getContactPoint(),
            $lodging->getStarRating(),
            $lodging->getQualityLabels(),
            Images::fromImages()
        );

        $this->assertFalse($lodging->sameValueAs($otherLodging));
    }

    /**
     * Same value if details are the same.
     *
     * @test
     */
    public function sameValueIfDetailsAreTheSame(): void
    {
        $lodging = $this->createLodging();
        $sameLodging = $this->createLodging();

        $this->assertTrue($lodging->sameValueAs($sameLodging));
    }

    /**
     * String version of the object is the list item name.
     *
     * @test
     */
    public function castToStringReturnsName(): void
    {
        $lodging = $this->createLodging();
        $this->assertEquals('Foo name', (string) $lodging);
    }

    /**
     * Create a lodging record to test with.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface
     */
    private function createLodging(): LodgingInterface
    {
        return Lodging::fromDetails(
            LodgingId::fromUri('http://foo.bar/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999'),
            'Foo name',
            'Foo description',
            15,
            Registration::fromTypeAndStatus('Biz', 'Baz'),
            Address::fromDetails(
                'Foo',
                '5',
                'b',
                '9000',
                'Baz',
                Coordinates::fromLongitudeLatitude(0, 0)
            ),
            ContactInfo::fromDetails(
                PhoneNumber::fromNumber('+32 9 123 12 12'),
                EmailAddress::fromAddress('info@foo.baz'),
                WebsiteAddress::fromUrl('https://foo.baz')
            ),
            StarRating::fromEuropeanFormat('4 *'),
            QualityLabels::fromLabels('Label 1', 'Label 2'),
            Images::fromImages(Image::fromUrl('http://foo.bar/image.jpg'))
        );
    }
}
