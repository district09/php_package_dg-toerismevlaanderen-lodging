<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Serializer;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses;

/**
 * Serializes a ContactInfo value into an array.
 */
final class ContactInfoArraySerializer
{
    /**
     * Serializes a given ContactInfo value into an array of data.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo $contactInfo
     *
     * @return array
     */
    public function serialize(ContactInfo $contactInfo): array
    {
        return [
            'phoneNumbers' => $this->serializePhoneNumbers($contactInfo->getPhoneNumbers()),
            'emailAddresses' => $this->serializeEmailAddresses($contactInfo->getEmailAddresses()),
            'websiteAddresses' => $this->serializeWebsiteAddresses($contactInfo->getWebsiteAddresses()),
        ];
    }

    /**
     * Serialize a phone numbers collection into an array.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers $phoneNumbers
     *
     * @return array
     */
    private function serializePhoneNumbers(PhoneNumbers $phoneNumbers): array
    {
        $data = [];
        foreach ($phoneNumbers->getIterator() as $phoneNumber) {
            /* @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber $phoneNumber */
            $data[] = $phoneNumber->getNumber();
        }

        return $data;
    }

    /**
     * Serialize the email addresses collection into an array.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses $emailAddresses
     *
     * @return array
     */
    private function serializeEmailAddresses(EmailAddresses $emailAddresses): array
    {
        $data = [];
        foreach ($emailAddresses->getIterator() as $emailAddress) {
            /* @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress $emailAddress */
            $data[] = $emailAddress->getAddress();
        }

        return $data;
    }

    /**
     * Serialize the website addresses collection into an array.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses $websiteAddresses
     *
     * @return array
     */
    private function serializeWebsiteAddresses(WebsiteAddresses $websiteAddresses): array
    {
        $data = [];
        foreach ($websiteAddresses->getIterator() as $websiteAddress) {
            /* @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress $websiteAddress */
            $data[] = $websiteAddress->getUrl();
        }

        return $data;
    }
}
