<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Exception;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidEmailAddress;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidEmailAddress
 */
class InvalidEmailAddressTest extends TestCase
{
    /**
     * Proper message is set when created from invalid email address.
     *
     * @test
     */
    public function exceptionForInvalidEmailAddressContainsProperMessage(): void
    {
        $exception = InvalidEmailAddress::notAnEmailAddress('foo.bar');
        $this->assertEquals(
            '"foo.bar" is not a valid email address.',
            $exception->getMessage()
        );
        $this->assertSame(400, $exception->getCode());
    }
}
