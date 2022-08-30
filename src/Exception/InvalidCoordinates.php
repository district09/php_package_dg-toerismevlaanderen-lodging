<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Exception;

use Exception;

/**
 * Invalid geo coordinates.
 */
final class InvalidCoordinates extends Exception
{
    /**
     * Create the exception from an invalid longitude value.
     *
     * @param float $longitude
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidCoordinates
     */
    public static function longitudeOutsideBounds(float $longitude): InvalidCoordinates
    {
        return new self(
            sprintf(
                'Longitude "%s" is outside -180° > 180° bounds.',
                $longitude
            ),
            400
        );
    }

    /**
     * Create the exception from an invalid latitude value.
     *
     * @param float $latitude
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidCoordinates
     */
    public static function latitudeOutsideBounds(float $latitude): InvalidCoordinates
    {
        return new static(
            sprintf(
                'Latitude "%s" is outside -90° > 90° bounds.',
                $latitude
            ),
            400
        );
    }
}
