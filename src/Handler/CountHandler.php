<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\CountRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Response\CountResponse;
use Psr\Http\Message as Psr;

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
     */
    public function toResponse(Psr\ResponseInterface $response): ResponseInterface
    {
        $data = json_decode($response->getBody()->getContents());
        return new CountResponse((int) $data->results->bindings[0]->count->value);
    }
}
