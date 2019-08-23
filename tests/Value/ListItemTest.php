<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem
 */
class ListItemTest extends TestCase
{
    /**
     * Item can be created from URI and name.
     *
     * @test
     */
    public function valueCanBeCreatedFromIdAndName(): void
    {
        $uri = 'http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999';
        $name = 'FooBar';
        $expectedLodgingId = LodgingId::fromUri($uri);

        $listItem = ListItem::fromUriAndName($uri, $name);
        $this->assertEquals($expectedLodgingId, $listItem->lodgingId());
        $this->assertEquals($name, $listItem->getName());
    }

    /**
     * Not the same value when different lodging id.
     *
     * @test
     */
    public function notSameValueWhenDifferentId(): void
    {
        $listItem = ListItem::fromUriAndName(
            'http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999',
            'FooBar'
        );
        $otherListItem = ListItem::fromUriAndName(
            'http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-888888',
            'FooBar'
        );

        $this->assertFalse($listItem->sameValueAs($otherListItem));
    }

    /**
     * Not the same value when different name.
     *
     * @test
     */
    public function notSameValueWhenDifferentName(): void
    {
        $listItem = ListItem::fromUriAndName(
            'http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999',
            'FooBar'
        );
        $otherListItem = ListItem::fromUriAndName(
            'http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999',
            'BizzBazz'
        );

        $this->assertFalse($listItem->sameValueAs($otherListItem));
    }

    /**
     * String version of the object is the list item name.
     *
     * @test
     */
    public function castToStringReturnsName(): void
    {
        $listItem = ListItem::fromUriAndName(
            'http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999',
            'FooBar'
        );
        $this->assertEquals('FooBar', (string) $listItem);
    }
}
