<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;

final class ContactPointArrayNormalizer
{
    /**
     * Normalizes a given array containing address data into an Address value.
     *
     * @param array $data
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Address
     */
    public function normalize(array $data): ContactInfo
    {
        $contactPointAddress = Address::fromDetails(
            $data['street'] ?? '',
            $data['houseNumber'] ?? '',
            $data['busNumber'] ?? '',
            $data['postalCode'] ?? '',
            $data['locality'] ?? ''
        );

        $phoneNumber = !empty($data['phoneNumber']) ? PhoneNumber::fromNumber($data['phoneNumber']) : PhoneNumber::withoutNumber();

        // TODO rename value in query.
        $emailAddress = !empty($data['emailAddress']) ? EmailAddress::fromAddress($data['emailAddress']) : EmailAddress::withoutAddress();

        // TODO rename value in query.
        $websiteAddress = !empty($data['websiteAddress']) ? WebsiteAddress::fromUrl($data['websiteAddress']) : WebsiteAddress::withoutUrl();

        return ContactInfo::fromDetails($contactPointAddress, $phoneNumber, $emailAddress, $websiteAddress);
    }
}
