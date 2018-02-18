<?php

namespace FredrikV\TextUtil\TextMeter;

/**
 * Class: FreeTypeTextMeter
 *
 * Measure text dimensions in pixels.
 *
 * @see TextMeterInterface
 */
class FreeTypeTextMeter implements TextMeterInterface
{
    /** @var float */
    private $fontSize;

    /** @var string */
    private $fontFile;

    /**
     * Construct FreeTypeMeter.
     *
     * @param float $fontSize font size in
     * @param string $fontFile
     */
    public function __construct(float $fontSize, string $fontFile)
    {
        $this->fontSize = $fontSize;
        $this->fontFile = $fontFile;
    }

    /**
     * {@inheritDoc}
     */
    public function getWidth(string $text) : float
    {
        $boundingBox = $this->getBoundingBox($text);

        return $boundingBox[2] - $boundingBox[0];
    }

    /**
     * {@inheritDoc}
     */
    public function getHeight(string $text) : float
    {
        $boundingBox = $this->getBoundingBox($text);

        return $boundingBox[1] - $boundingBox[5];
    }

    /**
     * Get bounding box according to imageftbbox
     *
     * @param string $text
     * @return array
     */
    private function getBoundingBox(string $text)
    {
        return \imageftbbox($this->fontSize, 0, $this->fontFile, $text);
    }
}
