<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Response\ListResponse;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Response\ListResponse
 */
class ListResponseTest extends TestCase
{
    /**
     * The response is a DTO.
     *
     * @test
     */
    public function responseContainsListItems(): void
    {
        $listItems = [
            ListItem::fromUriAndName('http://test.me/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-888888', 'FooBar'),
            ListItem::fromUriAndName('http://test.me/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999', 'BizBaz'),
        ];

        $response = new ListResponse($listItems);
        $this->assertSame($listItems, $response->items());
    }
}
