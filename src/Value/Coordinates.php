<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidCoordinates;

/**
 * A geolocation (longitude, latitude) value.
 */
final class Coordinates extends ValueAbstract
{
    /**
     * The longitude value.
     *
     * @var float
     */
    private $longitude;

    /**
     * The latitude value.
     *
     * @var float
     */
    private $latitude;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create a new value from longitude & latitude.
     *
     * @param float $longitude
     * @param float $latitude
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidCoordinates
     *   When longitude or latitude value is outside its bounds.
     */
    public static function fromLongitudeLatitude(float $longitude, float $latitude): Coordinates
    {
        static::assertIsLongitude($longitude);
        static::assertIsLatitude($latitude);

        $geoLocation = new static();
        $geoLocation->longitude = $longitude;
        $geoLocation->latitude = $latitude;

        return $geoLocation;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @inheritDoc
     *
     * @param \DigipolisGent\Value\ValueInterface|\DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem $object
     */
    public function sameValueAs(ValueInterface $object)
    {
        return $this->sameValueTypeAs($object)
            && $this->getLongitude() === $object->getLongitude()
            && $this->getLatitude() === $object->getLatitude()
        ;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return sprintf(
            'POINT (%s %s)',
            $this->getLongitude(),
            $this->getLatitude()
        );
    }

    /**
     * Validate if a given longitude value is a valid value.
     *
     * @param float $longitude
     *   Value to validate.
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidCoordinates
     */
    private static function assertIsLongitude(float $longitude): void
    {
        if ($longitude < -180 || $longitude > 180) {
            throw InvalidCoordinates::longitudeOutsideBounds($longitude);
        }
    }

    /**
     * Validate if a given latitude value is a valid value.
     *
     * @param float $latitude
     *   Value to validate.
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidCoordinates
     */
    private static function assertIsLatitude(float $latitude): void
    {
        if ($latitude < -90 || $latitude > 90) {
            throw InvalidCoordinates::latitudeOutsideBounds($latitude);
        }
    }
}
