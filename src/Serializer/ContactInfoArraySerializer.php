<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Serializer;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;

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
            'phoneNumber' => (string) $contactInfo->getPhoneNumber(),
            'emailAddress' => (string) $contactInfo->getEmailAddress(),
            'websiteAddress' => (string) $contactInfo->getWebsiteAddress(),
        ];
    }
}
