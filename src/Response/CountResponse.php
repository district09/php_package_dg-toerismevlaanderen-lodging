<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;

/**
 * Response containing the number of found lodgings.
 */
final class CountResponse implements ResponseInterface
{
    /**
     * The number of found lodgings.
     *
     * @var int
     */
    private $count;

    /**
     * Constructor.
     *
     * @param int $count
     */
    public function __construct(int $count)
    {
        $this->count = $count;
    }

    /**
     * Get the number of lodgings.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->count;
    }
}
