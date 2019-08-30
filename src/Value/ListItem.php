<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A lodging list item.
 */
final class ListItem extends ValueAbstract
{
    /**
     * The list item ID.
     *
     * @var string
     */
    private $id;

    /**
     * The list item URI.
     *
     * @var string
     */
    private $uri;

    /**
     * The list item name.
     *
     * @var string
     */
    private $name;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create a new value from URI and name.
     *
     * @param string $uri
     * @param string $name
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem
     */
    public static function fromUriAndName(string $uri, string $name): ListItem
    {
        $item = new static();
        $item->uri = $uri;
        $item->name = $name;

        $uriParts = explode('/', $uri);
        $item->id = array_pop($uriParts);

        return $item;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     *
     * @param \DigipolisGent\Value\ValueInterface|\DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem $object
     */
    public function sameValueAs(ValueInterface $object)
    {
        return $this->sameValueTypeAs($object)
            && $this->getUri() === $object->getUri()
            && $this->getName() === $object->getName()
        ;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->getName();
    }
}
