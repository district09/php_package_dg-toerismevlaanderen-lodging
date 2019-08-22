<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem;
use DigipolisGent\Value\ValueInterface;
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
    public function valueCanBeCreatedFromUriAndName(): void
    {
        $uri = 'http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999';
        $name = 'FooBar';

        $listItem = ListItem::fromUriAndName($uri, $name);
        $this->assertEquals('7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999', $listItem->getId());
        $this->assertEquals($uri, $listItem->getUri());
        $this->assertEquals($name, $listItem->getName());
    }

    /**
     * Not the same value when different value object types.
     *
     * @test
     */
    public function notSameValueIfDifferentTypes(): void
    {
        $notListItem = $this->prophesize(ValueInterface::class)->reveal();
        $listItem = ListItem::fromUriAndName(
            'http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999',
            'FooBar'
        );

        $this->assertFalse($listItem->sameValueAs($notListItem));
    }

    /**
     * Not the same value when different URI.
     *
     * @test
     */
    public function notSameValueWhenDifferentUri(): void
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
     * Same value if URI & Name are the same.
     *
     * @test
     */
    public function sameValueWhenSameUriAndName(): void
    {
        $listItem = ListItem::fromUriAndName(
            'http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999',
            'FooBar'
        );
        $otherListItem = ListItem::fromUriAndName(
            'http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999',
            'FooBar'
        );

        $this->assertTrue($listItem->sameValueAs($otherListItem));
    }

    /**
     * String version of the object is the list item name.
     *
     * @test
     */
    public function toStringIsName(): void
    {
        $listItem = ListItem::fromUriAndName(
            'http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999',
            'FooBar'
        );
        $this->assertEquals('FooBar', (string) $listItem);
    }
}
