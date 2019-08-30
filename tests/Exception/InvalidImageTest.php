<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Exception;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidImage;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidImage
 */
class InvalidImageTest extends TestCase
{
    /**
     * Proper message is set when created from invalid URL.
     *
     * @test
     */
    public function exceptionForInvalidImageUrlContainsProperMessage(): void
    {
        $exception = InvalidImage::notAnUrl('foo.bar');
        $this->assertEquals(
            '"foo.bar" is not a valid image URL.',
            $exception->getMessage()
        );
        $this->assertSame(400, $exception->getCode());
    }
}
