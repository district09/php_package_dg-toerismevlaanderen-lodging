<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging;

/**
 * Response containing the lodging detail.
 */
final class LodgingResponse implements ResponseInterface
{
    /**
     * Lodging value.
     *
     * @var Lodging
     */
    private $lodging;

    /**
     * Constructor.
     *
     * @param \DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging $lodging
     */
    public function __construct(Lodging $lodging)
    {
        $this->lodging = $lodging;
    }

    /**
     * Get the lodging value.
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Lodging
     */
    public function lodging(): Lodging
    {
        return $this->lodging;
    }
}
