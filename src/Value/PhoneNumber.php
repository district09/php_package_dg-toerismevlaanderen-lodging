<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * PhoneNumber value.
 */
final class PhoneNumber extends ValueAbstract
{
    /**
     * Phone number.
     *
     * @var string
     */
    private $number;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create a phone number.
     *
     * @param string $number
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber
     */
    public static function fromNumber(string $number): PhoneNumber
    {
        $phoneNumber = new static();
        $phoneNumber->number = $number;

        return $phoneNumber;
    }

    /**
     * Get the phone number.
     *
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        return $this->sameValueTypeAs($object)
            && $this->getNumber() === $object->getNumber();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->getNumber();
    }
}
