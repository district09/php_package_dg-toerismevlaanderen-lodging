<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Filter\LocalityFilter;
use DigipolisGent\Toerismevlaanderen\Lodging\Filter\RegistrationStatusFilter;
use DigipolisGent\Toerismevlaanderen\Lodging\LodgingService;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\CountRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Response\CountResponse;
use PHPUnit\Framework\TestCase;

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

        $request = new CountRequest($localityFilter, $registrationStatusFilter);
        $response = new CountResponse(123);

        $clientMock = $this->prophesize(ClientInterface::class);
        $clientMock->send($request)->willReturn($response);

        $service = new LodgingService($clientMock->reveal());
        $this->assertEquals(
            123,
            $service->count($localityFilter, $registrationStatusFilter)
        );
    }
}
