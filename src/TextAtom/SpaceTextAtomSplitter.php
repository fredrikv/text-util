<?php

namespace FredrikV\TextUtil\TextAtom;

class SpaceTextAtomSplitter implements TextAtomSplitterInterface
{
    /**
     * Split $string into smallest possible parts according to some rules.
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
