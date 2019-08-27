<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Lodging contact point details.
 */
final class ContactInfo extends ValueAbstract
{
    /**
     * Address.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\Address
     */
    private $address;

    /**
     * Phone number.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber
     */
    private $phoneNumber;

    /**
     * E-mail address.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress
     */
    private $emailAddress;

    /**
     * The website address.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress
     */
    private $websiteAddress;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create the contact from its details.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\Address $address
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber $phoneNumber
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress $emailAddress
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress $websiteAddress
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo
     */
    public static function fromDetails(
        Address $address,
        PhoneNumber $phoneNumber,
        EmailAddress $emailAddress,
        WebsiteAddress $websiteAddress
    ): ContactInfo {
        $contact = new static();
        $contact->address = $address;
        $contact->phoneNumber = $phoneNumber;
        $contact->emailAddress = $emailAddress;
        $contact->websiteAddress = $websiteAddress;

        return $contact;
    }

    /**
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber
     */
    public function getPhoneNumber(): PhoneNumber
    {
        return $this->phoneNumber;
    }

    /**
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress
     */
    public function getEmailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    /**
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress
     */
    public function getWebsiteAddress(): WebsiteAddress
    {
        return $this->websiteAddress;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object)
    {
        return $this->sameValueTypeAs($object)
            && $this->getAddress()->sameValueAs($object->getAddress())
            && $this->getPhoneNumber()->sameValueAs($object->getPhoneNumber())
            && $this->getEmailAddress()->sameValueAs($object->getEmailAddress())
            && $this->getWebsiteAddress()->sameValueAs($object->getWebsiteAddress());
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        $template = <<<EOT
%s
t: %s
m: %s
w: %s
EOT;

        return sprintf(
            $template,
            $this->getAddress(),
            $this->getPhoneNumber(),
            $this->getEmailAddress(),
            $this->getWebsiteAddress()
        );
    }
}
