<?php
/**
 * Created by PhpStorm.
 * User: broncha
 * Date: 7/29/15
 * Time: 11:53 AM
 */
namespace Fivedots\NepaliCalendar\Tests;

use Fivedots\NepaliCalendar\Calendar;
use Fivedots\NepaliCalendar\Provider\ArrayProvider;

class CalendarTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Calendar
     */
    private $calendar;
    /**
     * @var array
     */
    protected $nepToEnglish = array(
        'year' => 2014,
        'month' => 12,
        'date' => 31,
        'day' => 'Wednesday',
        'numDay' => 4,
        'nmonth' => 'December'
    );

    /**
     * @var array
     */
    protected $enToNepali = array(
        'year' => 2071,
        'month' => 9,
        'date' => 16,
        'day' => 'Wednesday',
        'numDay' => 4,
        'nmonth' => 'Poush'
    );

    protected function setUp()
    {
        $this->calendar = new Calendar(new ArrayProvider());
    }


    public function testNepaliToEnglishDate()
    {


        $date = $this->calendar->nepaliToEnglish(2071, 9, 16);
        $this->assertInternalType('array', $date);
        $this->assertSame($this->nepToEnglish, $date);
    }

    /**
     * @expectedException \Fivedots\NepaliCalendar\CalendarException
     */
    public function testNepaliToEnglishDateFail()
    {
        $date = $this->calendar->nepaliToEnglish(2043, 11, 31);
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
     * @param $year
     * @param $expectedResult
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
