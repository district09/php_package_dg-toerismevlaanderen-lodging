<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Filter\LocalityFilter;
use DigipolisGent\Toerismevlaanderen\Lodging\Filter\RegistrationStatusFilter;
use DigipolisGent\Toerismevlaanderen\Lodging\LodgingService;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\CountRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\LodgingRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\ListRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Response\CountResponse;
use DigipolisGent\Toerismevlaanderen\Lodging\Response\LodgingResponse;
use DigipolisGent\Toerismevlaanderen\Lodging\Response\ListResponse;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\LodgingService
 */
class LodgingServiceTest extends TestCase
{

    /**
     * Count method sends out the CountRequest and returns number of lodgings.
     *
     * @test
     */
    public function countMethodSendsCountRequestAndReturnsNumberOfLodgings(): void
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
    public function listMethodSendsListRequestAndReturnsLodgingsArray(): void
    {
        $localityFilter = new LocalityFilter('Foo');
        $registrationStatusFilter = new RegistrationStatusFilter('Biz', 'Baz');

        $listItems = [
            ListItem::fromUriAndName('http://test.me/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-888888', 'FooBar'),
            ListItem::fromUriAndName('http://test.me/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999', 'BizBaz'),
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

    /**
     * Lodging method sends out the DetailRequest and returns lodging details.
     *
     * @test
     */
    public function lodgingMethodSendsDetailRequestAndReturnsLodgingDetail(): void
    {
        $lodging = $this->prophesize(LodgingInterface::class)->reveal();
        $response = new LodgingResponse($lodging);

        $clientMock = $this->prophesize(ClientInterface::class);
        $clientMock
            ->send(Argument::type(LodgingRequest::class))
            ->willReturn($response);

        $service = new LodgingService($clientMock->reveal());
        $this->assertEquals(
            $lodging,
            $service->lodging('http://domain.be/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999')
        );
    }
}
