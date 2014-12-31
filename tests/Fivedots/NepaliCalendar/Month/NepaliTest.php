<?php

use Fivedots\NepaliCalendar\Month\Nepali;

class NepaliTest extends PHPUnit_Framework_TestCase
{

    /**
     * @param $index
     * @param $expectedResult
     * @dataProvider providerEnglishMonthName
     * @covers \Fivedots\NepaliCalendar\Month\Nepali::getTitle()
     */
    public function testGetEnglishMonthNameFromIndex($index, $expectedResult)
    {
        $result = Nepali::getTitle($index);
        $this->assertEquals($expectedResult, $result);
    }


    public function providerEnglishMonthName()
    {
        return array(
            array(3, "Ashar"),
            array(1, "Baisakh"),
            array(10, "Magh"),
        );
    }
}