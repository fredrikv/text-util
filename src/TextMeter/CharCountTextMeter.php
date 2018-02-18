<?php

namespace FredrikV\TextUtil\TextMeter;

/**
 * Class: CharCountTextMeter
 *
 * @see TextMeterInterface
 */
class CharCountTextMeter implements TextMeterInterface
{
    /**
     * {@inheritDoc}
     */
    public function getWidth(string $text) : float
    {
        $maxLength = 0;

        $lines = preg_split("/\\R/", $text);

        foreach ($lines as $line) {
            $maxLength = max($maxLength, mb_strlen($line));
        }

        return $maxLength;
    }
}
