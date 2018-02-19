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
     * @return string wrapped text
     */
    public function wrap(string $text) : string;
}
