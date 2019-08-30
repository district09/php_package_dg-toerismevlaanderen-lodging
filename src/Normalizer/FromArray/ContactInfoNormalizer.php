<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;

/**
 * Normalizes an array of data into a ContactInfo value.
 */
final class ContactInfoNormalizer
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
        $phoneNumber = !empty($data['phoneNumber'])
            ? PhoneNumber::fromNumber($data['phoneNumber'])
            : PhoneNumber::withoutNumber();
        $emailAddress = !empty($data['emailAddress'])
            ? EmailAddress::fromAddress($data['emailAddress'])
            : EmailAddress::withoutAddress();
        $websiteAddress = !empty($data['websiteAddress'])
            ? WebsiteAddress::fromUrl($data['websiteAddress'])
            : WebsiteAddress::withoutUrl();

        return ContactInfo::fromDetails($phoneNumber, $emailAddress, $websiteAddress);
    }
}
