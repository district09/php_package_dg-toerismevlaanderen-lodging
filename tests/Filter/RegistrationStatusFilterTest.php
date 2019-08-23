<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Filter;

use DigipolisGent\Toerismevlaanderen\Lodging\Filter\RegistrationStatusFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Filter\RegistrationStatusFilter
 */
class RegistrationStatusFilterTest extends TestCase
{
    /**
     * Where is by "gemeentenaam".
     *
     * @test
     */
    public function whereIsByTheRegistrationStatus(): void
    {
        $filter = new RegistrationStatusFilter('Foo');
        $this->assertSame(
            'tvl:heeftRegistratie/tvl:registratieStatus/skos:prefLabel ?registrationStatus;',
            $filter->where()
        );
    }

    /**
     * Filter contains proper identifier and localities.
     *
     * @test
     */
    public function filterContainsIdentifierAndLocalities(): void
    {
        $filter = new RegistrationStatusFilter('Foo', 'Bar');
        $this->assertSame(
            'FILTER (?registrationStatus = "Foo"@nl || ?registrationStatus = "Bar"@nl)',
            $filter->filter()
        );
    }
}
