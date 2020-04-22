<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses;
use InvalidArgumentException;

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
        $phoneVariable = sprintf('%s_phoneNumbers', $prefix);
        $phoneNumbers = $this->normalizePhoneNumbers($lodgingData->{$phoneVariable}->value ?? '');

        $emailVariable = sprintf('%s_emailAddresses', $prefix);
        $emailAddresses = $this->normalizeEmailAddresses($lodgingData->{$emailVariable}->value ?? '');

        $websiteVariable = sprintf('%s_websiteAddresses', $prefix);
        $websiteAddresses = $this->normalizeWebsiteAddresses($lodgingData->{$websiteVariable}->value ?? '');

        return ContactInfo::fromDetails(
            $phoneNumbers,
            $emailAddresses,
            $websiteAddresses
        );
    }

    /**
     * Create the phone numbers collection.
     *
     * @param string $data
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers
     */
    private function normalizePhoneNumbers(string $data): PhoneNumbers
    {
        $numbers = $this->extractValuesFromString($data);
        $phoneNumbers = [];
        foreach ($numbers as $number) {
            try {
                $phoneNumbers[] = PhoneNumber::fromNumber($number);
            } catch (InvalidArgumentException $exception) {
                continue;
            }
        }
        $phoneNumbers = array_reverse($phoneNumbers);

        return PhoneNumbers::fromPhoneNumbers(...$phoneNumbers);
    }

    /**
     * Create the email addresses collection.
     *
     * @param string $data
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses
     */
    private function normalizeEmailAddresses(string $data): EmailAddresses
    {
        $addresses = $this->extractValuesFromString($data);
        $emailAddresses = [];
        foreach ($addresses as $address) {
            $emailAddresses[] = EmailAddress::fromAddress($address);
        }
        $emailAddresses = array_reverse($emailAddresses);

        return EmailAddresses::fromEmailAddresses(...$emailAddresses);
    }

    /**
     * Create the website addresses collection.
     *
     * @param string $data
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses
     */
    private function normalizeWebsiteAddresses(string $data): WebsiteAddresses
    {
        $urls = $this->extractValuesFromString($data);
        $websiteAddresses = [];
        foreach ($urls as $url) {
            $websiteAddresses[] = WebsiteAddress::fromUrl($url);
        }
        $websiteAddresses = array_reverse($websiteAddresses);

        return WebsiteAddresses::fromWebsiteAddresses(...$websiteAddresses);
    }

    /**
     * Get the individual values from field with comma-separated values.
     *
     * @param string $value
     *
     * @return array
     */
    private function extractValuesFromString(string $value): array
    {
        return array_filter(
            array_map(
                'trim',
                explode(',', $value)
            )
        );
    }
}
