<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidEmailAddress;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Email address value.
 */
final class EmailAddress extends ValueAbstract
{
    /**
     * The address.
     *
     * @var string
     */
    private $address;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create an email address value from address.
     *
     * @param string $address
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidEmailAddress
     *   When the address string is not a valid email address.
     */
    public static function fromAddress(string $address): EmailAddress
    {
        static::assertEmailAddress($address);

        $emailAddress = new static();
        $emailAddress->address = $address;

        return $emailAddress;
    }

    /**
     * Create email address value without number.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress
     */
    public static function withoutAddress(): EmailAddress
    {
        $emailAddress = new static();
        $emailAddress->address = '';

        return $emailAddress;
    }

    /**
     * Get the email address.
     *
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object)
    {
        return $this->sameValueTypeAs($object)
            && $this->getAddress() === $object->getAddress();
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return $this->getAddress();
    }

    /**
     * Check if a given email address string is valid.
     *
     * @param string $address
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidEmailAddress
     */
    private static function assertEmailAddress(string $address): void
    {
        if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmailAddress::notAnEmailAddress($address);
        }
    }
}
