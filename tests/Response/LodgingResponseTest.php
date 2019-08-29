<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Response\LodgingResponse;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Address;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ContactInfo;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Coordinates;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\EmailAddress;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\PhoneNumber;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\WebsiteAddress;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Response\LodgingResponse
 */
class LodgingResponseTest extends TestCase
{
    /**
     * The response is a DTO.
     *
     * @test
     */
    public function responseContainsLodgingDetails(): void
    {
        $lodging = Lodging::fromDetails(
            LodgingId::fromUri('http://foo.bar/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999'),
            'Foo name',
            'Foo description',
            55,
            Registration::fromTypeAndStatus('B&B', 'Erkend'),
            Address::fromDetails('Foo street', '138', 'b', '9000', 'Foo locality', Coordinates::fromLongitudeLatitude(0, 0)),
            ContactInfo::fromDetails(
                PhoneNumber::fromNumber('+32 9 123 12 12'),
                EmailAddress::fromAddress('foo@biz.baz'),
                WebsiteAddress::fromUrl('http://foo.bar')
            ),
            StarRating::fromEuropeanFormat('3 *'),
            []
        );

        $response = new LodgingResponse($lodging);
        $this->assertSame($lodging, $response->lodging());
    }
}
