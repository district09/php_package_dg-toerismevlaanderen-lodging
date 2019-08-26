<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Exception;

use Exception;

/**
 * Invalid website address.
 */
class InvalidWebsiteAddress extends Exception
{
    /**
     * Create the exception from an invalid website URL.
     *
     * @param string $url
     *   The invalid website address URL.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidWebsiteAddress
     */
    public static function invalidUrl(string $url): InvalidWebsiteAddress
    {
        return new static(
            sprintf(
                '"%s" is not a valid website address URL.',
                $url
            ),
            400
        );
    }
}
