<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;

/**
 * Normalizes a json string into a Lodging value.
 */
final class LodgingJsonNormalizer
{
    /**
     * Normalizes a given json containing lodging data into a Lodging value.
     *
     * @param string $json
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging
     */
    public function normalize(string $json): Lodging
    {
        $data = json_decode($json);
        $lodgingData = $data->results->bindings[0];

        return Lodging::fromDetails(
            LodgingId::fromUri($lodgingData->_lodging->value),
            $lodgingData->name->value,
            $lodgingData->description->value ?? '',
            (int) $lodgingData->numberOfSleepingPlaces->value,
            $this->normalizeRegistration($lodgingData),
            $this->normalizeReceptionAddress($lodgingData),
            $this->normalizeContactPoint($lodgingData),
            StarRating::fromEuropeanFormat($lodgingData->starRating->value)
        );
    }

    /**
     * Extract the registration value from the json data.
     *
     * @param object $lodgingData
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration
     */
    private function normalizeRegistration(object $lodgingData): Registration
    {
        return $registration = Registration::fromTypeAndStatus(
            $lodgingData->registration_type->value,
            $lodgingData->registration_status->value
        );
    }

    /**
     * Extract the recpetion address from the json data.
     *
     * @param object $lodgingData
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Address
     */
    private function normalizeReceptionAddress(object $lodgingData): Address
    {
        return Address::fromDetails(
            $lodgingData->receptionAddress_street->value ?? '',
            $lodgingData->receptionAddress_houseNumber->value ?? '',
            $lodgingData->receptionAddress_busNumber->value ?? '',
            $lodgingData->receptionAddress_postalCode->value ?? '',
            $lodgingData->receptionAddress_locality->value ?? ''
        );
    }

    /**
     * Extract the contact point value from the json data.
     *
     * @param object $lodgingData
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo
     */
    private function normalizeContactPoint(object $lodgingData): ContactInfo
    {
        $phoneNumber = !empty($lodgingData->contactPoint_phoneNumber->value)
            ? PhoneNumber::fromNumber($lodgingData->contactPoint_phoneNumber->value)
            : PhoneNumber::withoutNumber();
        $emailAddress = !empty($lodgingData->contactPoint_emailAddress->value)
            ? EmailAddress::fromAddress($lodgingData->contactPoint_emailAddress->value)
            : EmailAddress::withoutAddress();
        $websiteAddress = !empty($lodgingData->contactPoint_websiteAddress->value)
            ? WebsiteAddress::fromUrl($lodgingData->contactPoint_websiteAddress->value)
            : WebsiteAddress::withoutUrl();

        return ContactInfo::fromDetails(
            $phoneNumber,
            $emailAddress,
            $websiteAddress
        );
    }
}
