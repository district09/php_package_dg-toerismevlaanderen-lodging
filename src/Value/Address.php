<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Address.
 */
final class Address extends ValueAbstract
{
    /**
     * The street name.
     *
     * @var string
     */
    private $street;

    /**
     * The house number.
     *
     * @var string
     */
    private $houseNumber;

    /**
     * The street bus number.
     *
     * @var string
     */
    private $busNumber;

    /**
     * The postal code.
     *
     * @var string
     */
    private $postalCode;

    /**
     * The locality.
     *
     * @var string
     */
    private $locality;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create a new address from its parts.
     *
     * @param string $street
     * @param string $houseNumber
     * @param string $busNumber
     * @param string $postalCode
     * @param string $locality
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Address
     */
    public static function fromDetails(string $street, string $houseNumber, string $busNumber, string $postalCode, string $locality): Address
    {
        $address = new static();
        $address->street = $street;
        $address->houseNumber = $houseNumber;
        $address->busNumber = $busNumber;
        $address->postalCode = $postalCode;
        $address->locality = $locality;

        return $address;
    }

    /**
     * Get the street name.
     *
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * Get the house number.
     *
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * Get the bus number.
     *
     * @return string
     */
    public function getBusNumber(): string
    {
        return $this->busNumber;
    }

    /**
     * Get the postal code.
     *
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * Get the locality name.
     *
     * @return string
     */
    public function getLocality(): string
    {
        return $this->locality;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object)
    {
        return $this->sameValueTypeAs($object)
            && $this->getStreet() === $object->getStreet()
            && $this->getHouseNumber() === $object->getHouseNumber()
            && $this->getBusNumber() === $object->getBusNumber()
            && $this->getPostalCode() === $object->getPostalCode()
            && $this->getLocality() === $object->getLocality();
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return sprintf(
            '%s %s%s, %s %s',
            $this->getStreet(),
            $this->getHouseNumber(),
            $this->getBusNumber() ? ' ' . $this->getBusNumber() : '',
            $this->getPostalCode(),
            $this->getLocality()
        );
    }
}
