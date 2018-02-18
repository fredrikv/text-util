<?php

namespace FredrikV\TextUtil\TextWrapper;

/**
 * Interface: TextWrapperInterface
 */
interface TextWrapperInterface
{
    /**
     * Wrap $text into lines.
     *
     * @param string $text
     * @return string[][] lines of text atoms
     */
    public function wrap(string $text);
}
