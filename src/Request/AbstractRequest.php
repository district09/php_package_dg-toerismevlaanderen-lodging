<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Request;

use GuzzleHttp\Psr7\Request;

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
        $method = 'GET';
        $uri = $this->uriFromQuery($query);
        $headers = ['Accept' => 'application/sparql-results+json'];
        $body = null;

        // Use POST if the query is bigger than 2kB.
        // 2046 = 2kB
        //        minus 1 for '?'.
        //        minus 1 for NULL-terminated string on server.
        if (strlen($uri) > 2046) {
            $method = 'POST';
            $body = $uri;
            $uri = '';
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        if ($uri) {
            $uri = '?' . $uri;
        }

        parent::__construct($method, $uri, $headers, $body);
    }

    /**
     * Create the uri string from the query string.
     *
     * @param string $query
     *
     * @return string
     */
    private function uriFromQuery(string $query): string
    {
        $clean = preg_replace('/\s+/', ' ', $query);
        return sprintf(
            'query=%s',
            urlencode(trim($clean))
        );
    }
}
