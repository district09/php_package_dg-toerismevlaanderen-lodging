<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A lodging value.
 */
final class Lodging extends ValueAbstract
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
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create a new lodging from its details.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId $lodgingId
     * @param string $name
     * @param string $description
     * @param int $numberOfSleepingPlaces
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration $registration
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo $contactPoint
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating $starRating
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging
     */
    public static function fromDetails(
        LodgingId $lodgingId,
        string $name,
        string $description,
        int $numberOfSleepingPlaces,
        Registration $registration,
        ContactInfo $contactPoint,
        StarRating $starRating
    ): Lodging {
        $lodging = new static();
        $lodging->lodgingId = $lodgingId;
        $lodging->name = $name;
        $lodging->description = $description;
        $lodging->numberOfSleepingPlaces = $numberOfSleepingPlaces;
        $lodging->registration = $registration;
        $lodging->contactPoint = $contactPoint;
        $lodging->starRating = $starRating;

        return $lodging;
    }

    /**
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId
     */
    public function getLodgingId(): LodgingId
    {
        return $this->lodgingId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getNumberOfSleepingPlaces(): int
    {
        return $this->numberOfSleepingPlaces;
    }

    /**
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration
     */
    public function getRegistration(): Registration
    {
        return $this->registration;
    }

    /**
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo
     */
    public function getContactPoint(): ContactInfo
    {
        return $this->contactPoint;
    }

    /**
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating
     */
    public function getStarRating(): StarRating
    {
        return $this->starRating;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object)
    {
        return $this->sameValueTypeAs($object)
            && $this->getLodgingId()->sameValueAs($object->getLodgingId())
            && $this->getName() === $object->getName()
            && $this->getDescription() === $object->getDescription()
            && $this->getNumberOfSleepingPlaces() === $object->getNumberOfSleepingPlaces()
            && $this->getRegistration()->sameValueAs($object->getRegistration())
            && $this->getContactPoint()->sameValueAs($object->getContactPoint())
            && $this->getStarRating()->sameValueAs($object->getStarRating())
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
