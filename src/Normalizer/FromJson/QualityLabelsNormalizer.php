<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Normalizer\FromJson;

use DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels;

/**
 * Normalizer to get the quality labels out of json decoded data.
 */
class QualityLabelsNormalizer
{
    /**
     * Extract the quality labels from the json data.
     *
     * @param object $lodgingData
     *
     * @return \DigipolisGent\Toerismevlaanderen\Lodging\Value\QualityLabels
     */
    public function normalize(object $lodgingData): QualityLabels
    {
        if (empty($lodgingData->qualityLabels->value)) {
            return QualityLabels::fromLabels();
        }

        $labels = array_reverse(
            explode(',', $lodgingData->qualityLabels->value)
        );

        return QualityLabels::fromLabels(...$labels);
    }
}
