<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidImage;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Image value.
 */
final class Image extends ValueAbstract
{
    /**
     * The image URI.
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
     * Create an image from its source URL.
     *
     * @param string $url
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Image
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidImage
     *   When the image URL is not valid.
     */
    public static function fromUrl(string $url): Image
    {
        static::assertImageUrl($url);

        $image = new static();
        $image->url = $url;

        return $image;
    }

    /**
     * Get the image URL.
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
        return $this->sameValueTypeAs($object)
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
     * Check if a given URL string is valid.
     *
     * @param string $url
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidImage
     */
    private static function assertImageUrl(string $url): void
    {
        if (!filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) {
            throw InvalidImage::notAnUrl($url);
        }
    }
}
