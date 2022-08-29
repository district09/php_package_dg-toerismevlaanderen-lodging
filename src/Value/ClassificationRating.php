<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A rating based on classification.
 */
final class ClassificationRating extends ValueAbstract implements RatingInterface
{
    /**
     * The available classifications.
     *
     * @var string
     */
    public const BASIC = 'Basic';
    public const COMFORT = 'Comfort';
    public const LUXE = 'Luxe';

    /**
     * The classification value.
     *
     * @var string
     */
    private $classification;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create the classification rating from string.
     *
     * The string should be:
     * - Basic
     * - Comfort
     * - Luxe
     *
     * @param string $classification
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\ClassificationRating
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating
     *   When value is not within the supported classifications.
     */
    public static function fromClassification(string $classification): ClassificationRating
    {
        static::assertClassification($classification);

        $classificationRating = new static();
        $classificationRating->classification = $classification;

        return $classificationRating;
    }

    /**
     * @inheritDoc
     */
    public function getRating(): string
    {
        return $this->classification;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        return $object instanceof self
            && $this->getRating() === $object->getRating();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->getRating();
    }

    /**
     * The rating string should be within the known values.
     *
     * @param string $classification
     *   The classification rating string to validate.
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating
     */
    private static function assertClassification(string $classification): void
    {
        $classifications = [static::BASIC, static::COMFORT, static::LUXE];
        if (!in_array($classification, $classifications)) {
            throw InvalidRating::classificationUnknown($classification);
        }
    }
}
