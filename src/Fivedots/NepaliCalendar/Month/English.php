<?php
namespace Fivedots\NepaliCalendar\Month;

use Fivedots\NepaliCalendar\CalendarException;
use Fivedots\NepaliCalendar\CalendarMessages;
//use Fivedots\NepaliCalendar\Month\MonthInterface;
use \DateTime;

class English implements MonthInterface
{
    const JANUARY = 1;
    const FEBRUARY = 2;
    const MARCH = 3;
    const APRIL = 4;
    const MAY = 5;
    const JUNE = 6;
    const JULY = 7;
    const AUGUST = 8;
    const SEPTEMBER = 9;
    const OCTOBER = 10;
    const NOVEMBER = 11;
    const DECEMBER = 12;

    public static function getTitle($index)
    {
        $dateObj = DateTime::createFromFormat('!m', $index);
        $monthName = $dateObj->format('F');
        return $monthName;
    }

    /**
     * Check if date range is in English
     *
     * @param int $yy Year
     * @param int $mm Month
     * @param int $dd Date
     * @return bool Return true on success otherwise returns CalendarException
     * @throws CalendarException Exception
     */
    public static function isValidRange($yy, $mm, $dd)
    {
        if ($yy < 1944 || $yy > 2033) {
            throw new CalendarException(CalendarMessages::E_UNSUPPORTED);
        }

        if ($mm < 1 || $mm > 12) {
            throw new CalendarException(CalendarMessages::E_BAD_MONTH_VALUE);
        }

        if ($dd < 1 || $dd > 31) {
            throw new CalendarException(CalendarMessages::E_BAD_DAY_VALUE);
        }

        return TRUE;
    }
}