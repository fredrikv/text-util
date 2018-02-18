<?php

namespace FredrikV\TextUtil\TextAtom;

/**
 * Interface: TextAtomSplitterInterface
 * Provides an interface to split text into its smallest possible parts
 * according to some rules.
 */
interface TextAtomSplitterInterface
{
    /**
     * Split $string into atoms
     *
     * @param string $text
     * @return string[] the smallest atoms according to the splitter rules
     */
    public function split(string $text) : array;
}
