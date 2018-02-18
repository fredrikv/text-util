<?php

namespace FredrikV\TextUtil\TextMeter;

/**
 * Class: FreeTypeTextMeter
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

    private function getBoundingBox($text)
    {
        return \imageftbbox($this->fontSize, 0, $this->fontFile, $text);
    }
}
