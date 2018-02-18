<?php

namespace FredrikV\TextUtil\TextMeter;

/**
 * Interface: TextMeterInterface
 *
 * Measure text dimensions in some unit.
 */
interface TextMeterInterface
{
    /**
     * Measure the width of $string in some unit.
     *
     * @param string $text
     * @return float string width
     */
    public function getWidth(string $text) : float;

    /**
     * Measure the height of $string in some unit.
     *
     * @param string $text
     * @return float string height
     */
    public function getHeight(string $text) : float;
}
