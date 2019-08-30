<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;

/**
 * Normalizer to get the contact info out of json decoded data.
 */
class ContactInfoNormalizer
{
    /**
     * Extract the reception address from the json data.
     *
     * @param object $lodgingData
     * @param string $prefix
     *   The prefix of the contact info variables.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo
     */
    public function normalize(object $lodgingData, string $prefix): ContactInfo
    {
        $phoneVariable = sprintf('%s_phoneNumber', $prefix);
        $phoneNumber = !empty($lodgingData->{$phoneVariable}->value)
            ? PhoneNumber::fromNumber($lodgingData->{$phoneVariable}->value)
            : PhoneNumber::withoutNumber();

        $emailVariable = sprintf('%s_emailAddress', $prefix);
        $emailAddress = !empty($lodgingData->{$emailVariable}->value)
            ? EmailAddress::fromAddress($lodgingData->{$emailVariable}->value)
            : EmailAddress::withoutAddress();

        $websiteVariable = sprintf('%s_websiteAddress', $prefix);
        $websiteAddress = !empty($lodgingData->{$websiteVariable}->value)
            ? WebsiteAddress::fromUrl($lodgingData->{$websiteVariable}->value)
            : WebsiteAddress::withoutUrl();

        return ContactInfo::fromDetails(
            $phoneNumber,
            $emailAddress,
            $websiteAddress
        );
    }
}
