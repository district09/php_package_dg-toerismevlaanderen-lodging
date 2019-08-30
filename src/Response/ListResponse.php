<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;

/**
 * Response containing the found lodgings list items.
 */
final class ListResponse implements ResponseInterface
{
    /**
     * List items
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem[]
     */
    private $items;

    /**
     * Constructor.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Get the list items.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem[]
     */
    public function items(): array
    {
        return $this->items;
    }
}
