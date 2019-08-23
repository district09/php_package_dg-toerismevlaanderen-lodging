<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Exception;

use Exception;

/**
 * Star rating value is not valid.
 */
class InvalidStarRating extends Exception
{
    /**
     * Create the exception from an invalid star rating string.
     *
     * @param string $starRating
     *   The invalid star rating.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidStarRating
     */
    public static function notInEuropeanFormat(string $starRating): InvalidStarRating
    {
        return new static(
            sprintf(
                '"%s" is not in the European Hotelstar\'s Union format.',
                $starRating
            ),
            400
        );
    }
}
