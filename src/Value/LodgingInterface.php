<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\ValueInterface;

/**
 * A lodging value.
 */
interface LodgingInterface extends ValueInterface
{
    /**
     * Get the lodging id.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId
     */
    public function getLodgingId(): LodgingId;

    /**
     * Get the name of the lodging.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the lodging description.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get the total number of available sleeping places.
     *
     * @return int
     */
    public function getNumberOfSleepingPlaces(): int;

    /**
     * Get the registration details.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration
     */
    public function getRegistration(): Registration;

    /**
     * Get the reception address.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Address
     */
    public function getReceptionAddress(): Address;

    /**
     * Get the contact point details.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo
     */
    public function getContactPoint(): ContactInfo;

    /**
     * Get the star rating.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating
     */
    public function getStarRating(): StarRating;

    /**
     * Get the quality labels.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels
     */
    public function getQualityLabels(): QualityLabels;

    /**
     * Get the lodging images.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Images
     */
    public function getImages(): Images;
}
