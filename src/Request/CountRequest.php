<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Request;

use DigipolisGent\Toerismevlaanderen\Lodging\Filter\FilterInterface;

/**
 * Request to get the number of lodgings that apply to provided filters.
 */
final class CountRequest extends AbstractFilteredRequest
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
     *   The filters to get the lodgings by.
     */
    public function __construct(FilterInterface ...$filters)
    {
        parent::__construct($this->query, ...$filters);
    }
}
