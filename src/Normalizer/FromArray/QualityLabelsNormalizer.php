<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromArray;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels;

/**
 * Normalizes an array of quality labels into a QualityLabels collection value.
 */
final class QualityLabelsNormalizer
{
    /**
     * Normalizes a given array containing quality labels.
     *
     * @param array $data
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels
     */
    public function normalize(array $data): QualityLabels
    {
        return QualityLabels::fromLabels(... $data);
    }
}
