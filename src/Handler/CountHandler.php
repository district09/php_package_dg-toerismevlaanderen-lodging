<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\API\Client\Exception\InvalidResponse;
use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\CountRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Response\CountResponse;
use Psr\Http\Message as Psr;
use RuntimeException;

/**
 * Handles the count request.
 */
final class CountHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [CountRequest::class];
    }

    /**
     * @inheritDoc
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData
     *   When the response dit not contain a count value.
     */
    public function toResponse(Psr\ResponseInterface $response): ResponseInterface
    {
        $data = json_decode($response->getBody()->getContents());
        $this->assertDataIsComplete($data);

        return new CountResponse((int) $data->results->bindings[0]->count->value);
    }

    /**
     * Assert that the response contains all necessary data.
     *
     * @param object
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData
     *   When the response does not contain a count value.
     */
    private function assertDataIsComplete($data): void
    {
        if (!isset($data->results->bindings[0]->count->value)) {
            throw MissingResponseData::count();
        }
    }
}
