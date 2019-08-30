<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Exception;

use Exception;

/**
 * Email address value is not valid.
 */
class InvalidEmailAddress extends Exception
{
    /**
     * Create the exception from an invalid email address.
     *
     * @param string $address
     *   The invalid email address.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidEmailAddress
     */
    public static function notAnEmailAddress(string $address): InvalidEmailAddress
    {
        return new static(
            sprintf(
                '"%s" is not a valid email address.',
                $address
            ),
            400
        );
    }
}
