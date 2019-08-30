<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray\RegistrationNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray\RegistrationNormalizer
 */
class RegistrationNormalizerTest extends TestCase
{
    /**
     * All registration data is normalized.
     *
     * @test
     */
    public function allLodgingDataIsNormalized(): void
    {
        $data = [
            'type' => 'B&B',
            'status' => 'Foo status',
        ];

        $expectedRegistration = Registration::fromTypeAndStatus('B&B', 'Foo status');

        $normalizer = new RegistrationNormalizer();
        $this->assertEquals(
            $expectedRegistration,
            $normalizer->normalize($data)
        );
    }
}
