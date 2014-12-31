<?php
use Fivedots\NepaliCalendar\Calendar;

class CalendarTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Fivedots\NepaliCalendar\Calendar
     */
    protected $calendar;

    protected $nepToEnglish = array(
        'year' => 2014,
        'month' => 12,
        'date' => 31,
        'day' => 'Wednesday',
        'numDay' => 4,
        'nmonth' => 'December'
    );
    protected $enToNepali = array(
        'year' => 2071,
        'month' => 9,
        'date' => 16,
        'day' => 'Wednesday',
        'numDay' => 4,
        'nmonth' => 'Poush'
    );

    public function setUp()
    {
        $this->calendar = new Calendar();
    }

    /**
     * @covers \Fivedots\NepaliCalendar\Calendar::nepaliToEnglish()
     * @throws \Fivedots\NepaliCalendar\CalendarException
     */
    public function testNepaliToEnglishDate()
    {
        $date = $this->calendar->nepaliToEnglish(2071, 9, 16);
        $this->assertInternalType('array', $date);
        $this->assertSame($this->nepToEnglish, $date);
    }

    /**
     * @covers \Fivedots\NepaliCalendar\Calendar::englishToNepali()
     * @throws \Fivedots\NepaliCalendar\CalendarException
     */
    public function testEnglishToNepaliDate()
    {
        $date = $this->calendar->englishToNepali(2014, 12, 31);
        $this->assertInternalType('array', $date);
        $this->assertSame($this->enToNepali, $date);
    }

    /**
     * @param int $year Year
     * @param int $expectedResult Actual Result for the supplied Year
     * @covers \Fivedots\NepaliCalendar\Calendar::isLeapYear()
     * @dataProvider providerTestIsLeapYear
     */
    public function testIsLeapYear($year,$expectedResult){
        $result = $this->calendar->isLeapYear($year);
        $this->assertEquals($expectedResult,$result);

    }

    /**
     * @return array Years to test as leap years
     */
    public function providerTestIsLeapYear(){
        return array(
            array(2006,false),
            array(2008,true),
            array(2010,false),
            array(2012,true),
            array(2013,false),
            array(2016,true),
        );
    }
}