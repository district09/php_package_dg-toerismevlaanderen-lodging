<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Request;

use GuzzleHttp\Psr7\Request;

/**
 * Abstract (SPARQL) request implementation.
 */
abstract class AbstractRequest extends Request
{
    /**
     * Create a new request from a given query.
     *
     * @param string $query
     *   The query to create the request for.
     */
    public function __construct(string $query)
    {
        $headers = [
            'Accept' => 'application/sparql-results+json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        parent::__construct('POST', '', $headers, $this->bodyFromQuery($query));
    }

    /**
     * Create the body string from the query string.
     *
     * @param string $query
     *
     * @return string
     */
    private function bodyFromQuery(string $query): string
    {
        $clean = preg_replace('/\s+/', ' ', $query);
        return sprintf(
            'query=%s',
            urlencode(trim($clean))
        );
    }
}
