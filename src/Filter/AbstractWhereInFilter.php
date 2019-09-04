<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Filter;

/**
 * Abstract implementation of a "WHERE field value IN values" filter.
 */
abstract class AbstractWhereInFilter implements FilterInterface
{
    /**
     * The items identifier.
     *
     * @var string
     */
    private $identifier;

    /**
     * The items to filter by.
     *
     * @var string[]
     */
    private $items = [];

    /**
     * Create from an array of items.
     *
     * @param string $identifier
     * @param string[] ...$items
     */
    public function __construct($identifier, string ...$items)
    {
        $this->identifier = $identifier;
        $this->items = $items;
    }

    /**
     * @inheritDoc
     */
    public function filter(): string
    {
        if (!$this->hasItems()) {
            return '';
        }

        $filters = [];
        foreach ($this->items as $item) {
            $filters[] = sprintf('?%s = "%s"@nl', $this->identifier, $item);
        }

        return sprintf('FILTER (%s)', implode(' || ', $filters));
    }

    /**
     * Are there items?
     *
     * @return bool
     */
    protected function hasItems(): bool
    {
        return !empty($this->items);
    }
}
