<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\ValueInterface;

/**
 * Rating interface.
 */
interface RatingInterface extends ValueInterface
{
    /**
     * Get the rating as a string.
     *
     * @return string
     */
    public function getRating(): string;
}
