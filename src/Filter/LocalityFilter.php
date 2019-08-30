<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Filter;

/**
 * Filter by one or more localities.
 */
final class LocalityFilter extends AbstractWhereInFilter
{
    /**
     * Create from an array of locality names.
     *
     * NOTE: the locality names should be in Dutch.
     *
     * @param string[] ...$localities
     */
    public function __construct(string ...$localities)
    {
        parent::__construct('locality', ...$localities);
    }

    /**
     * @inheritDoc
     */
    public function where(): string
    {
        return $this->hasItems()
            ? 'tvl:onthaalAdres/tva:gemeentenaam ?locality;'
            : '';
    }
}
