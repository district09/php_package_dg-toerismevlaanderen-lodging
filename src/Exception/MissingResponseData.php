<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Exception;

use Exception;

final class MissingResponseData extends Exception
{
    /**
     * Missing count data.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData
     */
    public static function count(): MissingResponseData
    {
        return new self('Response data does not contain count value.', 500);
    }

    /**
     * Missing list data.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData
     */
    public static function list(): MissingResponseData
    {
        return new self('Response data does not contain list record value.', 500);
    }

    /**
     * Missing detail data.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData
     */
    public static function lodging(): MissingResponseData
    {
        return new self('Response data does not contain lodging details.', 500);
    }
}
