<?php

namespace FredrikV\TextUtil\Test\TextAtom;

use PHPUnit\Framework\TestCase;
use FredrikV\TextUtil\TextAtom\SpaceTextAtomSplitter;

/**
 * Class: SpaceTextAtomSplitterTest
 *
 * @coversDefaultClass FredrikV\TextUtil\TextAtom\SpaceTextAtomSplitter
 *
 * @see TestCase
 */
class SpaceTextAtomSplitterTest extends TestCase
{
    public function setUp()
    {
        $this->textAtomSplitter = new SpaceTextAtomSplitter();
    }

    public function expectedResultProvider()
    {
        return [
            [ [ ],                                                                  '' ],
            [ [ 'SingleWord' ],                                                     'SingleWord' ],
            [ [ 'Space', ' ', 'retained' ],                                         'Space retained' ],
            [ [ 'Multiple', ' ', ' ', ' ', 'spaces', ' ', ' ', ' ', 'retained' ],   'Multiple   spaces   retained' ],
            [ [ 'Newline\nretained' ],                                              'Newline\nretained' ],
        ];
    }

    /**
     * @dataProvider expectedResultProvider
     *
     * @covers ::split
     *
     * @param string $input
     * @param array $expectedResult
     */
    public function testExpectedResult(array $expectedResult, string $input)
    {
        $this->assertEquals(
            $expectedResult,
            $this->textAtomSplitter->split($input)
        );
    }
}
