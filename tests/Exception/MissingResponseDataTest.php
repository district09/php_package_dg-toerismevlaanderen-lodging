<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Filter;

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
}
