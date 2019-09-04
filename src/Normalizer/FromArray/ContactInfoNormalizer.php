<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses;

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
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo
     */
    public function normalize(array $data): ContactInfo
    {
        return ContactInfo::fromDetails(
            $this->normalizePhoneNumbers($data['phoneNumbers'] ?? []),
            $this->normalizeEmailAddresses($data['emailAddresses'] ?? []),
            $this->normalizeWebsiteAddresses($data['websiteAddresses'] ?? [])
        );
    }

    /**
     * Normalize the phone numbers.
     *
     * @param string[] $numbers
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers
     */
    private function normalizePhoneNumbers(array $numbers): PhoneNumbers
    {
        $phoneNumbers = [];
        foreach ($numbers as $number) {
            $phoneNumbers[] = PhoneNumber::fromNumber($number);
        }

        return PhoneNumbers::fromPhoneNumbers(...$phoneNumbers);
    }

    /**
     * Normalize the email addresses.
     *
     * @param string[] $addresses
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses
     */
    private function normalizeEmailAddresses(array $addresses): EmailAddresses
    {
        $emailAddresses = [];
        foreach ($addresses as $address) {
            $emailAddresses[] = EmailAddress::fromAddress($address);
        }

        return EmailAddresses::fromEmailAddresses(...$emailAddresses);
    }

    /**
     * Normalize the website addresses.
     *
     * @param string[] $urls
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses
     */
    private function normalizeWebsiteAddresses(array $urls): WebsiteAddresses
    {
        $websiteAddresses = [];
        foreach ($urls as $url) {
            $websiteAddresses[] = WebsiteAddress::fromUrl($url);
        }

        return WebsiteAddresses::fromWebsiteAddresses(...$websiteAddresses);
    }
}
