<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData;
use DigipolisGent\Toerismevlaanderen\Lodging\Handler\ListHandler;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\ListRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Response\ListResponse;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ListItem;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Handler\ListHandler
 */
class ListHandlerTest extends TestCase
{
    use ProphecyTrait;

    /**
     * List request Json response content (reduced).
     *
     * @var string
     */
    private $listResponseContent = <<<EOT
{
  "results":{
    "bindings":[
      {
        "naam":{
          "value":"FooBar"
        },
        "_lodging":{
          "value":"http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-888888"
        }
      },
      {
        "naam":{
          "value":"BizBaz"
        },
        "_lodging":{
          "value":"http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999"
        }
      }
    ]
  }
}
EOT;

    /**
     * The handler handles ListRequest
     *
     * @test
     */
    public function handlesListRequest(): void
    {
        $expected = [ListRequest::class];
        $handler = new ListHandler();
        $this->assertEquals($expected, $handler->handles());
    }

    /**
     * The handler throws exception if count variable is not within response.
     *
     * @test
     */
    public function exceptionIfResponseDoesNotContainCountValue(): void
    {
        $bodyMock = $this->prophesize(Stream::class);
        $bodyMock->getContents()->willReturn('{}');
        $responseMock = $this->prophesize(ResponseInterface::class);
        $responseMock->getBody()->willReturn($bodyMock->reveal());

        $handler = new ListHandler();

        $this->expectException(MissingResponseData::class);
        $this->expectExceptionMessage('Response data does not contain list record value.');
        $handler->toResponse($responseMock->reveal());
    }

    /**
     * The handler extracts the list from the response.
     *
     * @test
     */
    public function extractsListResponse(): void
    {
        $bodyMock = $this->prophesize(Stream::class);
        $bodyMock->getContents()->willReturn($this->listResponseContent);
        $responseMock = $this->prophesize(ResponseInterface::class);
        $responseMock->getBody()->willReturn($bodyMock->reveal());

        $handler = new ListHandler();
        $this->assertEquals(
            new ListResponse([
                ListItem::fromUriAndName('http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-888888', 'FooBar'),
                ListItem::fromUriAndName('http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999', 'BizBaz'),
            ]),
            $handler->toResponse($responseMock->reveal())
        );
    }
}
