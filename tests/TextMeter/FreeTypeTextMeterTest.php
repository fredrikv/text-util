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
    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $this->textMeter = new FreeTypeTextMeter(
            12,
            '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf'
        );
    }

    /**
     * Expected widths
     * @return array
     */
    public function expectedWidthsProvider()
    {
        return [
            [ 0,  "" ],
            [ 11, "O" ],
        ];
    }

    /**
     * Expected heights
     * @return array
     */
    public function expectedHeightsProvider()
    {
        return [
            [ 12, "0" ],
            [ 33, "0\n0" ],
        ];
    }


    /**
     * @dataProvider expectedWidthsProvider
     *
     * @covers ::getWidth
     * @covers ::__construct
     *
     * @param string $input
     * @param array $expectedResult
     */
    public function testExpectedWidthResult(float $expectedWidth, string $input)
    {
        $this->assertEquals(
            $expectedWidth,
            $this->textMeter->getWidth($input)
        );
    }

    /**
     * @dataProvider expectedHeightsProvider
     *
     * @covers ::getHeight
     * @covers ::__construct
     *
     * @param string $input
     * @param array $expectedResult
     */
    public function testExpectedHeights(float $expectedHeight, string $input)
    {
        $this->assertEquals(
            $expectedHeight,
            $this->textMeter->getHeight($input)
        );
    }
}
