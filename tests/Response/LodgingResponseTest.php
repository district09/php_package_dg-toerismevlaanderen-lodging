<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Response\LodgingResponse;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Response\LodgingResponse
 */
class LodgingResponseTest extends TestCase
{
    use ProphecyTrait;

    /**
     * The response is a DTO.
     *
     * @test
     */
    public function responseContainsLodgingDetails(): void
    {
        $lodging = $this->prophesize(LodgingInterface::class)->reveal();
        $response = new LodgingResponse($lodging);
        $this->assertSame($lodging, $response->lodging());
    }
}
