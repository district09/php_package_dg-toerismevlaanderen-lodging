<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of phone numbers.
 */
final class PhoneNumbers extends CollectionAbstract
{
    /**
     * Create a collection from zero or more phone numbers.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber ...$phoneNumbers
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers
     */
    public static function fromPhoneNumbers(PhoneNumber ...$phoneNumbers): PhoneNumbers
    {
        $collection = new static();
        $collection->values = $phoneNumbers;
        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $numbers = [];
        foreach ($this->getIterator() as $phoneNumber) {
            /* @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber $phoneNumber */
            $numbers[] = $phoneNumber->getNumber();
        }

        return implode(', ', $numbers);
    }
}
