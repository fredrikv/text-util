<?php

namespace FredrikV\TextUtil\TextAtom;

/**
 * Class: SpaceTextAtomSplitter
 *
 * @see TextAtomSplitterInterface
 */
class SpaceTextAtomSplitter implements TextAtomSplitterInterface
{
    /**
     * Split $string into words and spaces.
     *
     * {@inheritDoc}
     */
    public function split(string $text) : array
    {
        return preg_split(
            '/( )/',
            $text,
            0,
            PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE
        );
    }
}
