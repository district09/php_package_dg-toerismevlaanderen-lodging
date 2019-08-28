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
            $lodgingData->type->value,
            $lodgingData->registrationStatus->value
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
        $address = Address::fromDetails(
            $lodgingData->street->value ?? '',
            $lodgingData->houseNumber->value ?? '',
            $lodgingData->busNumber->value ?? '',
            $lodgingData->postalCode->value ?? '',
            $lodgingData->locality->value ?? ''
        );

        $phoneNumber = !empty($lodgingData->phoneNumber->value)
            ? PhoneNumber::fromNumber($lodgingData->phoneNumber->value)
            : PhoneNumber::withoutNumber();
        $emailAddress = !empty($lodgingData->emailAddress->value)
            ? EmailAddress::fromAddress($lodgingData->emailAddress->value)
            : EmailAddress::withoutAddress();
        $websiteAddress = !empty($lodgingData->websiteAddress->value)
            ? WebsiteAddress::fromUrl($lodgingData->websiteAddress->value)
            : WebsiteAddress::withoutUrl();

        return ContactInfo::fromDetails(
            $address,
            $phoneNumber,
            $emailAddress,
            $websiteAddress
        );
    }
}
