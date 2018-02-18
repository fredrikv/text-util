<?php

namespace FredrikV\TextUtil\Test\TextWrapper;

use PHPUnit\Framework\TestCase;
use FredrikV\TextUtil\TextWrapper\TextWrapper;
use FredrikV\TextUtil\TextAtom\TextAtomSplitterInterface;
use FredrikV\TextUtil\TextMeter\TextMeterInterface;

/**
 * Class: TextWrapperTest
 *
 * @coversDefaultClass FredrikV\TextUtil\TextWrapper\TextWrapper
 *
 * @see TestCase
 */
class TextWrapperTest extends TestCase
{
    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $textAtomSplitter = $this->createTextAtomSplitterMock();
        $textMeter = $this->createTextMeterMock();

        $this->textWrapper = new TextWrapper(
            $textAtomSplitter,
            $textMeter,
            4
        );
    }

    /**
     * @return TextAtomSplitterInterface
     */
    private function createTextAtomSplitterMock()
    {
        $mock = $this
            ->getMockBuilder(TextAtomSplitterInterface::class)
            ->getMock();

        $mock->method('split')
            ->willReturnCallback(function (string $text) {
                return preg_split(
                    '/( )/',
                    $text,
                    0,
                    PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE
                );
            });

        return $mock;
    }

    /**
     * @return TextMeterInterface
     */
    private function createTextMeterMock()
    {
        $mock = $this
            ->getMockBuilder(TextMeterInterface::class)
            ->setMethods(['getWidth', 'getHeight'])
            ->getMock();

        $mock->method('getWidth')
            ->will($this->returnCallback('mb_strlen'));

        $mock->method('getHeight')
            ->will($this->returnCallback(function (string $text) {
                return count(preg_split(
                    "/(\\R)/",
                    $text
                ));
            }));

        return $mock;
    }

    /**
     * Expected text atoms and wraps
     * @return array
     */
    public function expectedResultProvider()
    {
        return [
            [ [ [ 'hi' ] ],                     "hi" ],
            [ [ [ 'hi', ' ' ], [ 'hi' ] ],      "hi hi" ],
            [ [ [ 'hiLong' ] ],                 "hiLong" ],
            [ [ [ 'hi', ' ' ], [ 'there' ] ],   "hi there" ]
        ];
    }

    /**
     * @dataProvider expectedResultProvider
     * @covers ::__construct
     * @covers ::wrap
     *
     * @param string $input
     * @param array $expectedResult
     */
    public function testExpectedResult(array $expectedResult, string $input)
    {
        $this->assertEquals(
            $expectedResult,
            $this->textWrapper->wrap($input)
        );
    }
}
