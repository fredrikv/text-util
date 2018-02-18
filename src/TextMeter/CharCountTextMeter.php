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

    /**
     * {@inheritDoc}
     */
    public function getHeight(string $text) : float
    {
        return count(preg_split(
            "/(\\R)/",
            $text,
            0,
            PREG_SPLIT_NO_EMPTY
        ));
    }
}
