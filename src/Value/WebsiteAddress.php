<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidWebsiteAddress;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;
use phpDocumentor\Reflection\Types\Self_;

/**
 * Website address value.
 */
final class WebsiteAddress extends ValueAbstract
{
    /**
     * The URL string.
     *
     * @var string
     */
    private $url;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create a Website Address value from an url.
     *
     * @param string $url
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidWebsiteAddress
     */
    public static function fromUrl(string $url): WebsiteAddress
    {
        static::assertWebsiteUrl($url);

        $websiteAddress = new static();
        $websiteAddress->url = preg_replace('#//86e934d00a8f/#', '//', $url);

        return $websiteAddress;
    }

    /**
     * Get the website address url.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        return $object instanceof self
            && $this->getUrl() === $object->getUrl();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->getUrl();
    }

    /**
     * Check if a given website URL string is valid.
     *
     * @param string $url
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidWebsiteAddress
     */
    private static function assertWebsiteUrl(string $url): void
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw InvalidWebsiteAddress::invalidUrl($url);
        }
    }
}
