<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Exception;

use Exception;

/**
 * Rating value is not valid.
 */
final class InvalidRating extends Exception
{
    /**
     * Value can not be mapped to a proper rating type.
     *
     * @param string $rating
     *   The rating value that can not be mapped.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating
     */
    public static function unknownType(string $rating): InvalidRating
    {
        return new self(
            sprintf(
                '"%s" rating value is of an unknown type.',
                $rating
            ),
            400
        );
    }

    /**
     * Create the exception from an unknown classification value.
     *
     * @param string $rating
     *   The invalid classification rating value.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating
     */
    public static function classificationUnknown(string $rating): InvalidRating
    {
        return new static(
            sprintf(
                '"%s" classification value is not within the known types.',
                $rating
            ),
            400
        );
    }

    /**
     * Create the exception from an invalid star rating string.
     *
     * @param string $rating
     *   The invalid star rating value.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating
     */
    public static function starRatingNotInEuropeanFormat(string $rating): InvalidRating
    {
        return new static(
            sprintf(
                '"%s" star rating value is not in the European Hotelstar\'s Union format.',
                $rating
            ),
            400
        );
    }

    /**
     * Create the exception from an invalid letter rating value.
     *
     * @param string $rating
     *   The invalid letter rating value.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating
     */
    public static function noLetter(string $rating): InvalidRating
    {
        return new static(
            sprintf(
                '"%s" is not a valid letter rating value.',
                $rating
            ),
            400
        );
    }
}
