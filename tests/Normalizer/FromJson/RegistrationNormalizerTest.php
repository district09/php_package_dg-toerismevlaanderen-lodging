<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\RegistrationNormalizer;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson\RegistrationNormalizer
 */
class RegistrationNormalizerTest extends TestCase
{
    /**
     * Full JSON data (reduced).
     *
     * @var string
     */
    private $completeJson = <<<EOT
{
  "results": {
    "bindings": [
      {
        "registration_type": {
          "xml:lang": "nl",
          "value": "B&B",
          "type": "literal"
        },
        "registration_status": {
          "xml:lang": "nl",
          "value": "Foo status",
          "type": "literal"
        }
      }
    ]
  }
}
EOT;

    /**
     * All registration data is normalized.
     *
     * @test
     */
    public function allLodgingDataIsNormalized(): void
    {
        $expectedRegistration = Registration::fromTypeAndStatus('B&B', 'Foo status');

        $jsonData = json_decode($this->completeJson)->results->bindings[0];

        $normalizer = new RegistrationNormalizer();
        $this->assertEquals(
            $expectedRegistration,
            $normalizer->normalize($jsonData, 'registration')
        );
    }
}
