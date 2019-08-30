<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData;
use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\LodgingNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\LodgingRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Response\LodgingResponse;
use Psr\Http\Message as Psr;

/**
 * Handles the lodging detail request.
 */
final class LodgingHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [LodgingRequest::class];
    }

    /**
     * @inheritDoc
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData
     */
    public function toResponse(Psr\ResponseInterface $response): ResponseInterface
    {
        $json = $response->getBody()->getContents();
        $this->assertDataIsComplete($json);

        $normalizer = new LodgingNormalizer();
        $lodging = $normalizer->normalize($json);

        return new LodgingResponse($lodging);
    }

    /**
     * Assert that the response contains all necessary data.
     *
     * @param string $json
     *   The response data in json format.
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData
     *   When the response does not contain the detail values.
     */
    private function assertDataIsComplete(string $json): void
    {
        $data = json_decode($json);
        if (!isset($data->results->bindings[0])) {
            throw MissingResponseData::lodging();
        }
    }
}
