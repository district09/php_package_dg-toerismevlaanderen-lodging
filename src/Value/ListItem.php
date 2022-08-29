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
     * The lodging id.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId
     */
    private $lodgingId;

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
        $item->lodgingId = LodgingId::fromUri($uri);
        $item->name = $name;

        return $item;
    }

    /**
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId
     */
    public function lodgingId(): LodgingId
    {
        return $this->lodgingId;
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
    public function sameValueAs(ValueInterface $object): bool
    {
        return $object instanceof self
            && $this->lodgingId()->sameValueAs($object->lodgingId())
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
