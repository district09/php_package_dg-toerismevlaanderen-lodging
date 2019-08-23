<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Handler\CountHandler;
use DigipolisGent\Toerismevlaanderen\Lodging\LodgingService;
use DigipolisGent\Toerismevlaanderen\Lodging\LodgingServiceFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\LodgingServiceFactory
 */
class LodgingServiceFactoryTest extends TestCase
{
    /**
     * Check if all the expected handlers are in place.
     *
     * @test
     */
    public function clientHasAllExpectedHandlers(): void
    {
        $clientMock = $this->prophesize(ClientInterface::class);
        $clientMock->addHandler(new CountHandler())->shouldBeCalled();

        $service = LodgingServiceFactory::create($clientMock->reveal());
        $this->assertInstanceOf(LodgingService::class, $service);
    }
}
