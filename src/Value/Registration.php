<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Lodging registration status.
 */
final class Registration extends ValueAbstract
{
    /**
     * The registration type.
     *
     * @var string
     */
    private $type;

    /**
     * The registration status.
     *
     * @var string
     */
    private $status;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create value from status and type.
     *
     * @param string $type
     * @param string $status
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\Registration
     */
    public static function fromTypeAndStatus(string $type, string $status): Registration
    {
        $registration = new static();
        $registration->type = $type;
        $registration->status = $status;

        return $registration;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object)
    {
        return $this->sameValueTypeAs($object)
            && $this->getType() === $object->getType()
            && $this->getStatus() === $object->getStatus();
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return sprintf('%s (%s)', $this->getType(), $this->getStatus());
    }
}
