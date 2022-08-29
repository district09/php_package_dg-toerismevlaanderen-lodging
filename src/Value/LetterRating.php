<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A rating in letters (A, B, C).
 */
final class LetterRating extends ValueAbstract implements RatingInterface
{
    /**
     * The letter rating.
     *
     * @var string
     */
    private $letter;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
        // Only allowed through named constructors.
    }

    /**
     * Create the letter rating from string.
     *
     * The string should contain only one letter (A, B, C, ...).
     *
     * Example:
     * <code>
     *   $letterRating = Letter::fromString('4 * sup');
     * </code>
     *
     * @param string $letter
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\LetterRating
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating
     *   When value is not in the correct format.
     *
     * @SuppressWarnings(PHPMD.UndefinedVariable)
     */
    public static function fromLetter(string $letter): LetterRating
    {
        static::assertFormat($letter);

        $rating = new static();
        $rating->letter = strtoupper($letter);

        return $rating;
    }

    /**
     * @inheritDoc
     */
    public function getRating(): string
    {
        return $this->letter;
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
     * The rating string should be a single letter.
     *
     * @param string $letter
     *   The letter string to validate.
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating
     */
    private static function assertFormat(string $letter): void
    {
        if (!preg_match('/^[a-zA-Z]$/', $letter)) {
            throw InvalidRating::noLetter($letter);
        }
    }
}
