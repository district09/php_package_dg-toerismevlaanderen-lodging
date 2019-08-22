<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Handler\CountHandler;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\CountRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Response\CountResponse;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Handler\CountHandler
 */
class CountHandlerTest extends TestCase
{

    /**
     * Count request Json response content (reduced).
     *
     * @var string
     */
    private $countResponseContent = <<<EOT
{
  "results":{
    "bindings":[
      {
        "count":{
          "value":"159"
        }
      }
    ]
  }
}
EOT;

    /**
     * The handler handles CountRequest
     *
     * @test
     */
    public function handlesCountRequest(): void
    {
        $expected = [CountRequest::class];
        $handler = new CountHandler();
        $this->assertEquals($expected, $handler->handles());
    }

    /**
     * The handler extracts the count from the response.
     *
     * @test
     */
    public function extractsCountResponse(): void
    {
        $bodyMock = $this->prophesize(Stream::class);
        $bodyMock->getContents()->willReturn($this->countResponseContent);
        $responseMock = $this->prophesize(ResponseInterface::class);
        $responseMock->getBody()->willReturn($bodyMock->reveal());

        $handler = new CountHandler();
        $this->assertEquals(
            new CountResponse(159),
            $handler->toResponse($responseMock->reveal())
        );
    }
}
