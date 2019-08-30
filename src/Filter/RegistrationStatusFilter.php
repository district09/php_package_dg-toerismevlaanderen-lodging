<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Filter;

/**
 * Filter by one or more registration statuses.
 */
final class RegistrationStatusFilter extends AbstractWhereInFilter
{
    /**
     * Create from an array of registration statusses.
     *
     * NOTE: the registration statuses should be in Dutch.
     *
     * @param string[] ...$statuses
     */
    public function __construct(string ...$statuses)
    {
        parent::__construct('registrationStatus', ...$statuses);
    }

    /**
     * @inheritDoc
     */
    public function where(): string
    {
        return $this->hasItems()
            ? 'tvl:heeftRegistratie/tvl:registratieStatus/skos:prefLabel ?registrationStatus;'
            : '';
    }
}
