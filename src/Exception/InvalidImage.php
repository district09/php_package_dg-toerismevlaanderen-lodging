<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Exception;

use Exception;

/**
 * Image value is not valid.
 */
class InvalidImage extends Exception
{
    /**
     * Create the exception from an invalid image URL.
     *
     * @param string $url
     *   The invalid URL.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidImage
     */
    public static function notAnUrl(string $url): InvalidImage
    {
        return new static(
            sprintf(
                '"%s" is not a valid image URL.',
                $url
            ),
            400
        );
    }
}
