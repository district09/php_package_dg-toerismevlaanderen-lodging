<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Exception;

final class InvalidLodgingUri extends \Exception
{
    /**
     * Create the exception from a provided URI string.
     *
     * @param string $uri
     *   The invalid URI.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidLodgingUri
     */
    public static function fromUri(string $uri): InvalidLodgingUri
    {
        return new self(
            sprintf('"%s" is not a valid lodging URI.', $uri),
            400
        );
    }
}
