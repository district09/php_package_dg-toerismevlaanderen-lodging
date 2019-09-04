<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of website addresses.
 */
final class WebsiteAddresses extends CollectionAbstract
{
    /**
     * Create a collection from zero or more website addresses.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress ...$websiteAddresses
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddresses
     */
    public static function fromWebsiteAddresses(WebsiteAddress ...$websiteAddresses): WebsiteAddresses
    {
        $collection = new static();
        $collection->values = $websiteAddresses;
        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $urls = [];
        foreach ($this->getIterator() as $websiteAddress) {
            /* @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress $websiteAddress */
            $urls[] = $websiteAddress->getUrl();
        }

        return implode(', ', $urls);
    }
}
