<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A no rating value.
 */
final class NoRating extends ValueAbstract implements RatingInterface
{
    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create a no-rating value.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\NoRating
     */
    public static function create(): NoRating
    {
        return new static();
    }

    /**
     * @inheritDoc
     */
    public function getRating(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        return $this->sameValueTypeAs($object);
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->getRating();
    }
}
