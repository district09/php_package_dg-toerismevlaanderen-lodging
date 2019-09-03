<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A lodging value.
 */
final class Lodging extends ValueAbstract implements LodgingInterface
{
    /**
     * The lodging id.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId
     */
    private $lodgingId;

    /**
     * The lodging name.
     *
     * @var string
     */
    private $name;

    /**
     * The lodging description.
     *
     * @var string
     */
    private $description;

    /**
     * Number of sleeping places.
     *
     * @var int
     */
    private $numberOfSleepingPlaces;

    /**
     * The registration.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration
     */
    private $registration;

    /**
     * The reception address.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\Address
     */
    private $receptionAddress;

    /**
     * The contact point.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo
     */
    private $contactPoint;

    /**
     * The star rating.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating
     */
    private $starRating;

    /**
     * The quality labels assigned to the lodging.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels
     */
    private $qualityLabels;

    /**
     * The lodging images.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\Images
     */
    private $images;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create a new lodging from its details.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId $lodgingId
     *   The lodging ID (based on the lodging URI).
     * @param string $name
     *   The lodging name.
     * @param string $description
     *   The lodging description.
     * @param int $numberOfSleepingPlaces
     *   The number of sleeping laces at the lodging.
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration $registration
     *   The registration details.
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\Address $receptionAddress
     *   The address of the lodging reception.
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo $contactPoint
     *   The contact details of the lodging.
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating $starRating
     *   The rating in number of stars of the lodging.
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels $qualityLabels
     *   The quality labels of the lodging.
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\Images $images
     *   The images collection.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface
     */
    public static function fromDetails(
        LodgingId $lodgingId,
        string $name,
        string $description,
        int $numberOfSleepingPlaces,
        Registration $registration,
        Address $receptionAddress,
        ContactInfo $contactPoint,
        StarRating $starRating,
        QualityLabels $qualityLabels,
        Images $images
    ): LodgingInterface {
        $lodging = new static();
        $lodging->lodgingId = $lodgingId;
        $lodging->name = $name;
        $lodging->description = $description;
        $lodging->numberOfSleepingPlaces = $numberOfSleepingPlaces;
        $lodging->registration = $registration;
        $lodging->receptionAddress = $receptionAddress;
        $lodging->contactPoint = $contactPoint;
        $lodging->starRating = $starRating;
        $lodging->qualityLabels = $qualityLabels;
        $lodging->images = $images;

        return $lodging;
    }

    /**
     * @inheritDoc
     */
    public function getLodgingId(): LodgingId
    {
        return $this->lodgingId;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @inheritDoc
     */
    public function getNumberOfSleepingPlaces(): int
    {
        return $this->numberOfSleepingPlaces;
    }

    /**
     * @inheritDoc
     */
    public function getRegistration(): Registration
    {
        return $this->registration;
    }

    /**
     * @inheritDoc
     */
    public function getReceptionAddress(): Address
    {
        return $this->receptionAddress;
    }

    /**
     * @inheritDoc
     */
    public function getContactPoint(): ContactInfo
    {
        return $this->contactPoint;
    }

    /**
     * @inheritDoc
     */
    public function getStarRating(): StarRating
    {
        return $this->starRating;
    }

    /**
     * @inheritDoc
     */
    public function getQualityLabels(): QualityLabels
    {
        return $this->qualityLabels;
    }

    /**
     * @inheritDoc
     */
    public function getImages(): Images
    {
        return $this->images;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        return $this->sameValueTypeAs($object)
            && $this->getLodgingId()->sameValueAs($object->getLodgingId())
            && $this->getName() === $object->getName()
            && $this->getDescription() === $object->getDescription()
            && $this->getNumberOfSleepingPlaces() === $object->getNumberOfSleepingPlaces()
            && $this->getRegistration()->sameValueAs($object->getRegistration())
            && $this->getReceptionAddress()->sameValueAs($object->getReceptionAddress())
            && $this->getContactPoint()->sameValueAs($object->getContactPoint())
            && $this->getStarRating()->sameValueAs($object->getStarRating())
            && $this->getQualityLabels()->sameValueAs($object->getQualityLabels())
            && $this->getImages()->sameValueAs($object->getImages())
        ;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->getName();
    }
}
