<?php

use Fivedots\NepaliCalendar\Month\English;

class EnglishTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerIsValidRangeValueReturn
     * @covers \Fivedots\NepaliCalendar\Month\English::isValidRange()
     */
    public function testIsValidRangeValueReturn($yy, $mm, $dd, $expectedResult)
    {
        $result = English::isValidRange($yy, $mm, $dd);
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @expectedException \Fivedots\NepaliCalendar\CalendarException
     * @dataProvider providerCalendarExceptionsThrown
     */
    public function testCalendarExceptionShouldBeThrown($yy, $mm, $dd, $expectedResult)
    {
        $results = English::isValidRange($yy, $mm, $dd);
        $this->assertEquals($expectedResult, $results);
    }

    /**
     * @param $index
     * @param $expectedResult
     * @covers \Fivedots\NepaliCalendar\Month\English::getTitle()
     * @dataProvider providerEnglishMonthName
     */
    public function testGetEnglishMonthNameFromIndex($index, $expectedResult)
    {
        $result = English::getTitle($index);
        $this->assertEquals($expectedResult, $result);
    }

    public function providerIsValidRangeValueReturn()
    {
        return array(
            array(2014, 12, 31, true),
            array(2010, 03, 01, true),
            array(2015, 03, 01, true),
        );
    }

    public function providerCalendarExceptionsThrown()
    {
        return array(
            array(2055, 01, 01, true),
            array(2075, 01, 01, true),
            array(1941, 01, 01, true),
            array(1922, 01, 01, true),
        );
    }

    public function providerEnglishMonthName()
    {
        return array(
            array(3, "March"),
            array(1, "January"),
            array(10, "October"),
        );
    }
}