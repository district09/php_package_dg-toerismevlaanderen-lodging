<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Request;

use DigipolisGent\Toerismevlaanderen\Lodging\Filter\FilterInterface;

/**
 * Request to get the number of lodges filtered by their locality and statuses.
 */
final class CountRequest extends AbstractRequest
{

    /**
     * The query string.
     *
     * @var string
     */
    private $query = <<<EOT
PREFIX tvl: <https://data.vlaanderen.be/ns/logies#>
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
PREFIX tva: <https://data.vlaanderen.be/ns/adres#>
PREFIX schema: <http://schema.org/>
SELECT (COUNT(?_lodging) AS ?count)
WHERE {
    ?_lodging a tvl:Logies;
    %s
    schema:name ?naam.
    %s
}
EOT;

    /**
     * Construct a new request.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Filter\FilterInterface ...$filters
     *   The filters to get the lodges by.
     */
    public function __construct(FilterInterface ...$filters)
    {
        $whereParts = [];
        $filterParts = [];
        foreach ($filters as $filter) {
            $whereParts[] = $filter->where();
            $filterParts[] = $filter->filter();
        }

        $query = sprintf(
            $this->query,
            implode(PHP_EOL, $whereParts),
            implode(PHP_EOL, $filterParts)
        );

        parent::__construct($query);
    }
}
