<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Filter\LocalityFilter;
use DigipolisGent\Toerismevlaanderen\Lodging\Filter\RegistrationStatusFilter;
use DigipolisGent\Toerismevlaanderen\Lodging\LodgingService;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\CountRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\ListRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Response\CountResponse;
use DigipolisGent\Toerismevlaanderen\Lodging\Response\ListResponse;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\LodgingService
 */
class LodgingServiceTest extends TestCase
{

    /**
     * Count method sends out the CountRequest and returns the number of lodges.
     *
     * @test
     */
    public function countMethodSendsCountRequestAndReturnsNumberOfLodges(): void
    {
        $localityFilter = new LocalityFilter('Foo');
        $registrationStatusFilter = new RegistrationStatusFilter('Biz', 'Baz');

        $response = new CountResponse(123);

        $clientMock = $this->prophesize(ClientInterface::class);
        $clientMock
            ->send(Argument::type(CountRequest::class))
            ->willReturn($response);

        $service = new LodgingService($clientMock->reveal());
        $this->assertEquals(
            123,
            $service->count($localityFilter, $registrationStatusFilter)
        );
    }

    /**
     * List method sends out the ListRequest and returns the array of lodgings.
     *
     * @test
     */
    public function listMethodSendsListRequestAndReturnsLodgesArray(): void
    {
        $localityFilter = new LocalityFilter('Foo');
        $registrationStatusFilter = new RegistrationStatusFilter('Biz', 'Baz');

        $listItems = [
            ListItem::fromUriAndName('http://test.me/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-888888', 'FooBar'),
            ListItem::fromUriAndName('http://test.me/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999', 'BizBaz'),
        ];
        $response = new ListResponse($listItems);

        $clientMock = $this->prophesize(ClientInterface::class);
        $clientMock
            ->send(Argument::type(ListRequest::class))
            ->willReturn($response);

        $service = new LodgingService($clientMock->reveal());
        $this->assertEquals(
            $listItems,
            $service->list($localityFilter, $registrationStatusFilter)
        );
    }
}
