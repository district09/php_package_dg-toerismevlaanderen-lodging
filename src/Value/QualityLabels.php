<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use ArrayIterator;
use DigipolisGent\Value\CollectionInterface;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Collection of quality labels.
 */
final class QualityLabels extends ValueAbstract implements CollectionInterface
{
    /**
     * The labels strings.
     *
     * @var string[]
     */
    private $labels;

    /**
     * Force named constructors.
     */
    protected function __construct()
    {
    }

    /**
     * Create the collection from zero or more labels.
     *
     * @param string ...$labels
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels
     */
    public static function fromLabels(string ...$labels): QualityLabels
    {
        $qualityLabels = new static();
        $qualityLabels->labels = $labels;

        return $qualityLabels;
    }

    /**
     * Get all label strings as array.
     *
     * @return string[]
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->labels);
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        return $object instanceof self
            && !array_diff($this->getLabels(), $object->getLabels());
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return implode(', ', $this->labels);
    }
}
