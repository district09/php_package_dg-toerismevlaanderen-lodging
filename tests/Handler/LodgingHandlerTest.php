<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData;
use DigipolisGent\Toerismevlaanderen\Lodging\Handler\LodgingHandler;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\LodgingRequest;
use DigipolisGent\Toerismevlaanderen\Lodging\Response\LodgingResponse;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Handler\LodgingHandler
 */
class LodgingHandlerTest extends TestCase
{

    /**
     * List request Json response content (reduced).
     *
     * @var string
     */
    private $detailResponseContent = <<<EOT
{
  "results": {
    "ordered": true,
    "distinct": false,
    "bindings": [
      {
        "_lodging": {
          "value": "http://foo.bar/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999",
          "type": "uri"
        },
        "name": {
          "xml:lang": "nl",
          "value": "Foo name",
          "type": "literal"
        },
        "description": {
          "xml:lang": "nl",
          "value": "Foo description",
          "type": "literal"
        },
        "type": {
          "xml:lang": "nl",
          "value": "B&B",
          "type": "literal"
        },
        "registrationStatus": {
          "xml:lang": "nl",
          "value": "Erkend",
          "type": "literal"
        },
        "numberOfSleepingPlaces": {
          "value": "55",
          "type": "typed-literal",
          "datatype": "http://www.w3.org/2001/XMLSchema#integer"
        },
        "street": {
          "value": "Foo street",
          "type": "literal"
        },
        "houseNumber": {
          "value": "138",
          "type": "literal"
        },
        "busNumber": {
          "value": "b",
          "type": "literal"
        },
        "postalCode": {
          "value": "9000",
          "type": "literal"
        },
        "locality": {
          "xml:lang": "nl",
          "value": "Foo locality",
          "type": "literal"
        },
        "phoneNumber": {
          "value": "+32 9 123 12 12",
          "type": "literal"
        },
        "emailAddress": {
          "value": "foo@biz.baz",
          "type": "literal"
        },
        "websiteAddress": {
          "value": "http://foo.bar",
          "type": "uri"
        },
        "starRating": {
          "value": "3 *",
          "type": "literal"
        }
      }
    ]
  }
}
EOT;

    /**
     * The handler handles LodgingRequest
     *
     * @test
     */
    public function handlesLodgingRequest(): void
    {
        $expected = [LodgingRequest::class];
        $handler = new LodgingHandler();
        $this->assertEquals($expected, $handler->handles());
    }

    /**
     * The handler throws exception if response has no data.
     *
     * @test
     */
    public function exceptionIfResponseDoesNotContainLodgingData(): void
    {
        $bodyMock = $this->prophesize(Stream::class);
        $bodyMock->getContents()->willReturn('{}');
        $responseMock = $this->prophesize(ResponseInterface::class);
        $responseMock->getBody()->willReturn($bodyMock->reveal());

        $handler = new LodgingHandler();

        $this->expectException(MissingResponseData::class);
        $this->expectExceptionMessage('Response data does not contain lodging details.');
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
        $bodyMock->getContents()->willReturn($this->detailResponseContent);
        $responseMock = $this->prophesize(ResponseInterface::class);
        $responseMock->getBody()->willReturn($bodyMock->reveal());

        $expectedResponse = new LodgingResponse(
            Lodging::fromDetails(
                LodgingId::fromUri('http://foo.bar/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999'),
                'Foo name',
                'Foo description',
                55,
                Registration::fromTypeAndStatus('B&B', 'Erkend'),
                ContactInfo::fromDetails(
                    Address::fromDetails('Foo street', '138', 'b', '9000', 'Foo locality'),
                    PhoneNumber::fromNumber('+32 9 123 12 12'),
                    EmailAddress::fromAddress('foo@biz.baz'),
                    WebsiteAddress::fromUrl('http://foo.bar')
                ),
                StarRating::fromEuropeanFormat('3 *')
            )
        );

        $handler = new LodgingHandler();
        $this->assertEquals(
            $expectedResponse,
            $handler->toResponse($responseMock->reveal())
        );
    }
}
