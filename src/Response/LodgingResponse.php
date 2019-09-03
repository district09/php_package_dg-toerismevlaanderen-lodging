<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface;

/**
 * Response containing the lodging detail.
 */
final class LodgingResponse implements ResponseInterface
{
    /**
     * Lodging value.
     *
     * @var \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface
     */
    private $lodging;

    /**
     * Constructor.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface $lodging
     */
    public function __construct(LodgingInterface $lodging)
    {
        $this->lodging = $lodging;
    }

    /**
     * Get the lodging value.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\LodgingInterface
     */
    public function lodging(): LodgingInterface
    {
        return $this->lodging;
    }
}
