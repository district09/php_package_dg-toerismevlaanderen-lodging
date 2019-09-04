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
     * Phone number.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers
     */
    private $phoneNumbers;

    /**
     * E-mail address.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses
     */
    private $emailAddresses;

    /**
     * The website addresses.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses
     */
    private $websiteAddresses;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create the contact from its details.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers $phoneNumbers
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses $emailAddresses
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses $websiteAddresses
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo
     */
    public static function fromDetails(
        PhoneNumbers $phoneNumbers,
        EmailAddresses $emailAddresses,
        WebsiteAddresses $websiteAddresses
    ): ContactInfo {
        $contact = new static();
        $contact->phoneNumbers = $phoneNumbers;
        $contact->emailAddresses = $emailAddresses;
        $contact->websiteAddresses = $websiteAddresses;

        return $contact;
    }

    /**
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumbers
     */
    public function getPhoneNumbers(): PhoneNumbers
    {
        return $this->phoneNumbers;
    }

    /**
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddresses
     */
    public function getEmailAddresses(): EmailAddresses
    {
        return $this->emailAddresses;
    }

    /**
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses
     */
    public function getWebsiteAddresses(): WebsiteAddresses
    {
        return $this->websiteAddresses;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        return $this->sameValueTypeAs($object)
            && $this->getPhoneNumbers()->sameValueAs($object->getPhoneNumbers())
            && $this->getEmailAddresses()->sameValueAs($object->getEmailAddresses())
            && $this->getWebsiteAddresses()->sameValueAs($object->getWebsiteAddresses());
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $template = <<<EOT
t: %s
m: %s
w: %s
EOT;

        return sprintf(
            $template,
            $this->getPhoneNumbers(),
            $this->getEmailAddresses(),
            $this->getWebsiteAddresses()
        );
    }
}
