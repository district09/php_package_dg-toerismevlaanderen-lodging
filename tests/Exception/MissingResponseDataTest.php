<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Exception;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Exception\MissingResponseData
 */
class MissingResponseDataTest extends TestCase
{
    /**
     * From count contains the proper message.
     *
     * @test
     */
    public function exceptionForCountContainsProperMessage(): void
    {
        $exception = MissingResponseData::count();
        $this->assertEquals('Response data does not contain count value.', $exception->getMessage());
        $this->assertSame(500, $exception->getCode());
    }

    /**
     * From list contains the proper message.
     *
     * @test
     */
    public function exceptionForListContainsProperMessage(): void
    {
        $exception = MissingResponseData::list();
        $this->assertEquals('Response data does not contain list record value.', $exception->getMessage());
        $this->assertSame(500, $exception->getCode());
    }

    /**
     * From detail contains the proper message.
     *
     * @test
     */
    public function exceptionForlodgingContainsProperMessage(): void
    {
        $exception = MissingResponseData::lodging();
        $this->assertEquals('Response data does not contain lodging details.', $exception->getMessage());
        $this->assertSame(500, $exception->getCode());
    }
}
