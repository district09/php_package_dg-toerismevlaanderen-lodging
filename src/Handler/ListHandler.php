<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\ListRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Response\ListResponse;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem;
use Psr\Http\Message as Psr;

/**
 * Handles the list request.
 */
final class ListHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [ListRequest::class];
    }

    /**
     * @inheritDoc
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData
     */
    public function toResponse(Psr\ResponseInterface $response): ResponseInterface
    {
        $data = json_decode($response->getBody()->getContents());
        $this->assertDataIsComplete($data);

        $listItems = [];
        foreach ($data->results->bindings as $itemData) {
            $listItems[] = ListItem::fromUriAndName(
                $itemData->_lodging->value,
                $itemData->naam->value
            );
        }

        return new ListResponse($listItems);
    }

    /**
     * Assert that the response contains all necessary data.
     *
     * @param object
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData
     *   When the response does not contain the list values.
     */
    private function assertDataIsComplete($data): void
    {
        if (!isset($data->results->bindings)) {
            throw MissingResponseData::list();
        }
    }
}
