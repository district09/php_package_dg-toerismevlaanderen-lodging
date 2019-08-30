<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidLodgingUri;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A lodging id.
 */
final class LodgingId extends ValueAbstract
{
    /**
     * The list item URI.
     *
     * @var string
     */
    private $uri;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create the id from a given uri.
     *
     * @param string $uri
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId
     */
    public static function fromUri(string $uri): LodgingId
    {
        self::assertLodgingUri($uri);

        $lodgingId = new static();
        $lodgingId->uri = $uri;
        return $lodgingId;
    }

    /**
     * Get the lodging record id.
     *
     * @return int
     */
    public function getId(): int
    {
        preg_match('#-([\d]{6})$#', $this->getUri(), $matches);
        return (int) $matches[1];
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        return $this->sameValueTypeAs($object)
            && $this->getUri() === $object->getUri();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return (string) $this->getId();
    }

    /**
     * Check if the given URI is valid.
     *
     * @param string $uri
     *   The URI to validate.
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidLodgingUri
     */
    private static function assertLodgingUri(string $uri): void
    {
        if (!preg_match(
            '#lodgings/[\da-f]{8}-[\da-f]{4}-[\da-f]{4}-[\da-f]{4}-[\da-f]{12}-[\d]{6}$#',
            $uri
        )) {
            throw InvalidLodgingUri::fromUri($uri);
        }
    }
}
