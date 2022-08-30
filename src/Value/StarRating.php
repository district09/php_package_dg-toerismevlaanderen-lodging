<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Value;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A rating in number of stars.
 */
final class StarRating extends ValueAbstract implements RatingInterface
{
    /**
     * The star rating pattern.
     *
     * @var string
     */
    private const EUROPEAN_FORMAT_PATTERN = '#^([1-5]) \*( sup)?$#';

    /**
     * The number of stars.
     *
     * @var int
     */
    private $numberOfStars;

    /**
     * Is superior.
     *
     * @var bool
     */
    private $isSuperior;

    /**
     * Disable constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Create the star rating from string.
     *
     * The string should be in the European Hotelstar's Union format.
     * @link https://en.wikipedia.org/wiki/Hotel_rating#European_Hotelstar's_Union
     *
     * Example:
     * <code>
     *   $starRating = StarRating::fromString('4 * sup');
     * </code>
     *
     * @param string $rating
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating
     *   When value is not in the correct format.
     *
     * @SuppressWarnings(PHPMD.UndefinedVariable)
     */
    public static function fromEuropeanFormat(string $rating): StarRating
    {
        static::assertEuropeanFormat($rating);
        preg_match(static::EUROPEAN_FORMAT_PATTERN, $rating, $matches);

        $starRating = new static();
        $starRating->numberOfStars = (int) $matches[1];
        $starRating->isSuperior = !empty($matches[2]);

        return $starRating;
    }

    /**
     * @inheritDoc
     */
    public function getRating(): string
    {
        return sprintf(
            $this->isSuperior ? '%d * sup' : '%d *',
            $this->getNumberOfStars()
        );
    }

    /**
     * @return int
     */
    public function getNumberOfStars(): int
    {
        return $this->numberOfStars;
    }

    /**
     * @return bool
     */
    public function isSuperior(): bool
    {
        return $this->isSuperior;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        return $object instanceof self
            && $this->getNumberOfStars() === $object->getNumberOfStars()
            && $this->isSuperior() === $object->isSuperior();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->getRating();
    }

    /**
     * The rating string should be in the European Hotelstar's Union format.
     *
     * @param string $starRating
     *   The star rating string to validate.
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating
     */
    private static function assertEuropeanFormat(string $starRating): void
    {
        if (!preg_match(static::EUROPEAN_FORMAT_PATTERN, $starRating)) {
            throw InvalidRating::starRatingNotInEuropeanFormat($starRating);
        }
    }
}
