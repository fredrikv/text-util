<?php

namespace FredrikV\TextUtil\Test\TextMeter;

use PHPUnit\Framework\TestCase;
use FredrikV\TextUtil\TextMeter\CharCountTextMeter;

/**
 * Class: CharCountTextMeterTest
 *
 * @coversDefaultClass FredrikV\TextUtil\TextMeter\CharCountTextMeter
 *
 * @see TestCase
 */
class CharCountTextMeterTest extends TestCase
{
    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $this->textMeter = new CharCountTextMeter();
    }

    /**
     * Expected widths
     * @return array
     */
    public function expectedWidthsProvider()
    {
        return [
            [ 0,  "" ],
            [ 13, "numberOfChars" ],
            [ 10, "thelongest\nof\nlines_n" ],
            [ 10, "thelongest\r\nof\r\nlines_rn" ],
            [ 10, "thelongest\rof\rlines_r" ],
            [ 0,  "\r\n\r\r\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\r\r\r\r\r\r\r\r\r\r\r\r\r\r" ]
        ];
    }

    /**
     * Expected heights
     * @return array
     */
    public function expectedHeightsProvider()
    {
        return [
            [ 0,  "" ],
            [ 1, "numberOfChars" ],
            [ 3, "thelongest\nof\nlines_n" ],
            [ 3, "thelongest\r\nof\r\nlines_rn" ],
            [ 3, "thelongest\rof\rlines_r" ],
        ];
    }


    /**
     * @dataProvider expectedWidthsProvider
     *
     * @covers ::getWidth
     *
     * @param float $expectedResult
     * @param string $input
     */
    public function testExpectedWidths(float $expectedWidth, string $input)
    {
        $this->assertEquals(
            $expectedWidth,
            $this->textMeter->getWidth($input)
        );
    }

    /**
     * @dataProvider expectedHeightsProvider
     *
     * @covers ::getWidth
     *
     * @param float $expectedResult
     * @param string $input
     */
    public function testExpectedHeights(float $expectedHeight, string $input)
    {
        $this->assertEquals(
            $expectedHeight,
            $this->textMeter->getHeight($input)
        );
    }
}
