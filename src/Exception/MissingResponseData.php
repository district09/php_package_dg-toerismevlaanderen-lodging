<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Exception;

use Exception;

class MissingResponseData extends Exception
{
    /**
     * Missing count data.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData
     */
    public static function count(): MissingResponseData
    {
        return new static('Response data does not contain count value.', 500);
    }
}
