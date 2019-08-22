<?php

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Filter;

use DigipolisGent\Toerismevlaanderen\Lodging\Filter\LocalityFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Filter\AbstractWhereInFilter
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Filter\LocalityFilter
 */
class LocalityFilterTest extends TestCase
{
    /**
     * No where & filter if there are no localities in the filter.
     *
     * @test
     */
    public function whereAndFilterAreEmptyWhenThereAreNoLocalities(): void
    {
        $filter = new LocalityFilter();
        $this->assertSame('', $filter->where());
        $this->assertSame('', $filter->filter());
    }

    /**
     * Where is by "gemeentenaam".
     *
     * @test
     */
    public function whereIsByTheGemeentenaam(): void
    {
        $filter = new LocalityFilter('Foo');
        $this->assertSame(
            'tvl:onthaalAdres/tva:gemeentenaam ?locality;',
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
        $filter = new LocalityFilter('Foo', 'Bar');
        $this->assertSame(
            'FILTER (?locality = "Foo"@nl || ?locality = "Bar"@nl)',
            $filter->filter()
        );
    }
}
