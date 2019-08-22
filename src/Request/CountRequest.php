<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Request;

/**
 * Request to get the number of lodges filtered by their locality and statuses.
 */
class CountRequest extends AbstractRequest
{
    /**
     * Construct a new request.
     *
     * @param string $locality
     *   The locality to get the lodges for.
     * @param string[] $statuses
     *   Array of statuses to filter the lodges by (OR).
     */
    public function __construct(string $locality, array $statuses)
    {
        parent::__construct($this->createQuery($locality, $statuses));
    }

    /**
     * Create the query string.
     *
     * @param string $locality
     *   The locality to get the lodges for.
     * @param string[] $statuses
     *   Array of statuses to filter the lodges by (OR).
     *
     * @return string
     */
    private function createQuery(string $locality, array $statuses): string
    {
        $query = <<<EOT
PREFIX tvl: <https://data.vlaanderen.be/ns/logies#>
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
PREFIX tva: <https://data.vlaanderen.be/ns/adres#>
PREFIX schema: <http://schema.org/>
SELECT (COUNT(?_lodging) AS ?count)
WHERE {
    ?_lodging a tvl:Logies;
    tvl:onthaalAdres/tva:gemeentenaam "%s"@nl;
    tvl:heeftRegistratie/tvl:registratieStatus/skos:prefLabel ?regstatus;
    schema:name ?naam.
    %s
}
EOT;

        return sprintf(
            $query,
            $locality,
            $this->createStatusesFilter($statuses)
        );
    }

    /**
     * Create the status filters.
     *
     * @param string[] $statuses
     *   Array of statuses to filter the lodges by (OR).
     *
     * @return string
     */
    private function createStatusesFilter(array $statuses): string
    {
        if (!$statuses) {
            return '';
        }

        $items = [];
        foreach ($statuses as $status) {
            $items[] = sprintf('?regstatus = "%s"@nl', $status);
        }

        return sprintf('FILTER (%s) .', implode(' || ', $items));
    }
}
