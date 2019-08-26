<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Exception;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidWebsiteAddress;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidWebsiteAddress
 */
class InvalidWebsiteAddressTest extends TestCase
{
    /**
     * Proper message is set when created from invalid website URL.
     *
     * @test
     */
    public function exceptionForInvalidUrlContainsProperMessage(): void
    {
        $exception = InvalidWebsiteAddress::invalidUrl('foo.bar');
        $this->assertEquals(
            '"foo.bar" is not a valid website address URL.',
            $exception->getMessage()
        );
        $this->assertSame(400, $exception->getCode());
    }
}
