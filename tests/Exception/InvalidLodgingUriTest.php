<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Exception;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidLodgingUri;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidLodgingUri
 */
class InvalidLodgingUriTest extends TestCase
{
    /**
     * From URI.
     *
     * @test
     */
    public function exceptionFromUriContainsProperMessage(): void
    {
        $uri = 'http://linked.toerismevlaanderen.be/fooBar';
        $exception = InvalidLodgingUri::fromUri($uri);
        $this->assertEquals(
            '"http://linked.toerismevlaanderen.be/fooBar" is not a valid lodging URI.',
            $exception->getMessage()
        );
        $this->assertSame(400, $exception->getCode());
    }
}
