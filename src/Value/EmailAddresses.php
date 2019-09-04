<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of email addresses.
 */
final class EmailAddresses extends CollectionAbstract
{
    /**
     * Create a collection from zero or more email addresses.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress ...$emailAddresses
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses
     */
    public static function fromEmailAddresses(EmailAddress ...$emailAddresses): EmailAddresses
    {
        $collection = new static();
        $collection->values = $emailAddresses;
        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $addresses = [];
        foreach ($this->getIterator() as $emailAddress) {
            /* @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress $emailAddress */
            $addresses[] = $emailAddress->getAddress();
        }

        return implode(', ', $addresses);
    }
}
