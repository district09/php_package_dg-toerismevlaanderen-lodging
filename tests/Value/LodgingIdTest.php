<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Handler;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidLodgingUri;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingId
 */
class LodgingIdTest extends TestCase
{
    /**
     * Exception thrown if the URI is not valid.
     *
     * @test
     */
    public function invalidLodgingUriExceptionWhenInvalidUriProvided(): void
    {
        $invalid = 'http://linked.toerismevlaanderen.be/id/foo/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999';
        $this->expectException(InvalidLodgingUri::class);
        LodgingId::fromUri($invalid);
    }

    /**
     * Id is extracted from the URI.
     *
     * @test
     */
    public function idIsExtractedFromUri(): void
    {
        $uri = 'http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999';
        $lodgingId = LodgingId::fromUri($uri);
        $this->assertSame(999999, $lodgingId->getId());
    }

    /**
     * Not equal if URI values are not the same.
     *
     * @test
     */
    public function valuesNotSameIfUriIsDifferent(): void
    {
        $lodgingId = LodgingId::fromUri('http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999');
        $otherId = LodgingId::fromUri('http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-888888');

        $this->assertFalse($lodgingId->sameValueAs($otherId));
    }

    /**
     * The id value is used for the string representation.
     *
     * @test
     */
    public function castToStringReturnsId(): void
    {
        $lodgingId = LodgingId::fromUri('http://linked.toerismevlaanderen.be/id/lodgings/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999');
        $this->assertSame('999999', (string) $lodgingId);
    }
}
