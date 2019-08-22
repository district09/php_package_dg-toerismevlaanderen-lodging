<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Request;

use DigipolisGent\Toerismevlaanderen\Lodging\Filter\LocalityFilter;
use DigipolisGent\Toerismevlaanderen\Lodging\Filter\RegistrationStatusFilter;
use DigipolisGent\Toerismevlaanderen\Lodging\Request\CountRequest;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Request\AbstractRequest
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Request\CountRequest
 */
class CountRequestTest extends TestCase
{
    /**
     * The constructor creates the proper URI.
     *
     * @test
     */
    public function uriContainsQuery(): void
    {
        $request = new CountRequest(
            new LocalityFilter('Gent'),
            new RegistrationStatusFilter('Erkend', 'Vergund')
        );
        $expected = '?query=PREFIX+tvl%3A+%3Chttps%3A%2F%2Fdata.vlaanderen.be%2Fns%2Flogies%23%3E+PREFIX+skos%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2004%2F02%2Fskos%2Fcore%23%3E+PREFIX+tva%3A+%3Chttps%3A%2F%2Fdata.vlaanderen.be%2Fns%2Fadres%23%3E+PREFIX+schema%3A+%3Chttp%3A%2F%2Fschema.org%2F%3E+SELECT+%28COUNT%28%3F_lodging%29+AS+%3Fcount%29+WHERE+%7B+%3F_lodging+a+tvl%3ALogies%3B+tvl%3AonthaalAdres%2Ftva%3Agemeentenaam+%3Flocality%3B+tvl%3AheeftRegistratie%2Ftvl%3AregistratieStatus%2Fskos%3AprefLabel+%3FregistrationStatus%3B+schema%3Aname+%3Fnaam.+FILTER+%28%3Flocality+%3D+%22Gent%22%40nl%29+FILTER+%28%3FregistrationStatus+%3D+%22Erkend%22%40nl+%7C%7C+%3FregistrationStatus+%3D+%22Vergund%22%40nl%29+%7D';
        $this->assertSame($expected, (string) $request->getUri());
    }
}
