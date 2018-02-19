<?php

namespace FredrikV\TextUtil\TextWrapper;

use FredrikV\TextUtil\TextAtom\TextAtomSplitterInterface;
use FredrikV\TextUtil\TextMeter\TextMeterInterface;
use FredrikV\TextUtil\TextWrapper\TextWrapperInterface;

/**
 * Class: TextWrapper
 */
class TextWrapper implements TextWrapperInterface
{
    /** @var TextAtomSplitterInterface */
    private $textAtomSplitter;

    /** @var TextMeterInterface */
    private $textMeter;

    /** @var float */
    private $maxWidth;

    /**
     * Constructor
     *
     * @param TextAtomSplitterInterface $textAtomSplitter
     * @param TextMeterInterface $textMeter
     * @param float $maxWidth
     */
    public function __construct(
        TextAtomSplitterInterface $textAtomSplitter,
        TextMeterInterface $textMeter,
        float $maxWidth
    ) {
        $this->textAtomSplitter = $textAtomSplitter;
        $this->textMeter        = $textMeter;
        $this->maxWidth         = $maxWidth;
    }

    /**
     * {@inheritDoc}
     */
    public function wrap(string $text) : string
    {
        $lines = [ [] ];

        $textAtoms = $this->textAtomSplitter->split($text);

        foreach ($textAtoms as $textAtom) {
            $oldLine       = array_pop($lines);
            $newLine       = array_merge($oldLine, [ $textAtom ]);
            $newLineString = implode('', $newLine);

            $atomFits = $this->maxWidth > $this->textMeter->getWidth($newLineString);

            // Allow overflow of long words to avoid infinite loops
            if ($atomFits || empty($oldLine)) {
                array_push($lines, $newLine);
            } else {
                array_push($lines, $oldLine);
                array_push($lines, [ $textAtom ]);
            }
        }

        return $this->linesToString(
            $lines
        );
    }

    private function linesToString(array $atomLines)
    {
        // Wrap text
        $lines = [];
        foreach ($atomLines as $atomLine) {
            $lines[] = implode('', $atomLine);
        }

        return implode(PHP_EOL, $lines);
    }
}
