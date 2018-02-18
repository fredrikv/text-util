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
        $this->textMeter = new FreeTypeTextMeter(12, '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf');
    }

    public function expectedResultProvider()
    {
        return [
            [ 0,  "" ],
            [ 12, "O" ],
        ];
    }

    /**
     * @dataProvider expectedResultProvider
     *
     * @covers ::getWidth
     * @covers ::__construct
     *
     * @param string $input
     * @param array $expectedResult
     */
    public function testExpectedResult(float $expectedResult, string $input)
    {
        $this->assertEquals(
            $expectedResult,
            $this->textMeter->getWidth($input)
        );
    }
}
