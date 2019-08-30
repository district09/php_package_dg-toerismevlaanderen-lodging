<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Response\CountResponse;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Response\CountResponse
 */
class CountResponseTest extends TestCase
{
    /**
     * The response is a DTO.
     *
     * @test
     */
    public function responseContainsCount(): void
    {
        $response = new CountResponse(1234);
        $this->assertSame(1234, $response->count());
    }
}
