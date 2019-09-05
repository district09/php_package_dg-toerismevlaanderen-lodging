<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromString;

use DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\ClassificationRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\NoRating;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\RatingInterface;
use DigipolisGent\Toerismevlaanderen\Lodging\Value\StarRating;
use Exception;

/**
 * Normalizes a given value into a proper Rating value.
 */
final class RatingNormalizer
{
    /**
     * Normalizes a given value into a proper Rating value.
     *
     * @param string|null $rating
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\RatingInterface
     *
     * @throws \DigipolisGent\Toerismevlaanderen\Lodging\Exception\InvalidRating
     */
    public function normalize(?string $rating): RatingInterface
    {
        if (empty($rating)) {
            return NoRating::create();
        }

        try {
            return StarRating::fromEuropeanFormat($rating);
        } catch (Exception $exception) {
            // Ignore.
        }

        try {
            return ClassificationRating::fromClassification($rating);
        } catch (Exception $exception) {
            // Ignore.
        }

        throw InvalidRating::unknownType($rating);
    }
}
