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
    public function setUp()
    {
        $this->textMeter = new CharCountTextMeter();
    }

    public function expectedWidthResultProvider()
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

    public function expectedHeightResultProvider()
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
     * @dataProvider expectedWidthResultProvider
     *
     * @covers ::getWidth
     *
     * @param string $input
     * @param array $expectedResult
     */
    public function testExpectedWidthResult(float $expectedResult, string $input)
    {
        $this->assertEquals(
            $expectedResult,
            $this->textMeter->getWidth($input)
        );
    }

    /**
     * @dataProvider expectedHeightResultProvider
     *
     * @covers ::getWidth
     *
     * @param string $input
     * @param array $expectedResult
     */
    public function testExpectedHeightResult(float $expectedResult, string $input)
    {
        $this->assertEquals(
            $expectedResult,
            $this->textMeter->getHeight($input)
        );
    }
}
