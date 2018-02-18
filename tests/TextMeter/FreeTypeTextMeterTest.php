<?php

namespace FredrikV\TextUtil\Test\TextMeter;

use PHPUnit\Framework\TestCase;
use FredrikV\TextUtil\TextMeter\FreeTypeTextMeter;

/**
 * Class: FreeTypeMeterTest
 *
 * @coversDefaultClass FredrikV\TextUtil\TextMeter\FreeTypeTextMeter
 *
 * @see TestCase
 */
class FreeTypeMeterTest extends TestCase
{
    public function setUp()
    {
        $this->textMeter = new FreeTypeTextMeter(
            12,
            '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf'
        );
    }

    public function expectedWidthResultProvider()
    {
        return [
            [ 0,  "" ],
            [ 11, "O" ],
        ];
    }

    public function expectedHeightResultProvider()
    {
        return [
            [ 14, "0" ],
            [ 14*2 + 3, "O\n0" ],
        ];
    }


    /**
     * @dataProvider expectedWidthResultProvider
     *
     * @covers ::getWidth
     * @covers ::__construct
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
     * @covers ::getHeight
     * @covers ::__construct
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
