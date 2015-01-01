<?php
namespace Fivedots\NepaliCalendar;

use Fivedots\NepaliCalendar\Month\Nepali;
use Fivedots\NepaliCalendar\Month\English;

class Calendar
{
    // Data for nepali date
    private $_bs;

    public function __construct(IDataProvider $dp){
        $this->_bs = $dp->getAvailableDates();
    }


    /**
     * Calculates whether english year is leap year or not
     *
     * @param int $year Year to check for leap year
     * @return bool If is leap year return true otherwise false
     */
    public function isLeapYear($year)
    {
        $a = $year;
        if ($a % 100 == 0) {
            if ($a % 400 == 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            if ($a % 4 == 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    /**
     * Returns converted English date for the supplied Nepali date
     * @param $year int Year (2071)
     * @param $month int Month (09)
     * @param $date  int Date (16)
     * @return array Converted English Date
     * @throws CalendarException CalendarException
     */
    public function nepaliToEnglish($year, $month, $date)
    {
        $def_eyy = 1943;
        $def_emm = 4;
        $def_edd = 14 - 1;  // initial english date.
        $def_nyy = 2000;
        $total_nDays = 0;
        $day = 4 - 1;
        $k = 0;

        $monthData = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
        $lmonth = array(0,31,29,31,30,31,30,31,31,30,31,30,31);

        // Check for date range
        $chk = Nepali::isValidRange($year, $month, $date);

        if ($chk !== TRUE) {
            throw new CalendarException(CalendarMessages::E_OUT_OF_RANGE, $year, $month, $date);
        } else {
            // Count total days in-terms of year
            for ($i = 0; $i < ($year - $def_nyy); $i++) {
                for ($j = 1; $j <= 12; $j++) {
                    $total_nDays += $this->_bs[$k][$j];
                }
                $k++;
            }

            // Count total days in-terms of month
            for ($j = 1; $j < $month; $j++) {
                $total_nDays += $this->_bs[$k][$j];
            }

            // Count total days in-terms of dat
            $total_nDays += $date;

            // Calculation of equivalent english date...
            $totalEnglishDays = $def_edd;
            $m = $def_emm;
            $y = $def_eyy;
            while ($total_nDays != 0) {
                if ($this->isLeapYear($y)) {
                    $a = $lmonth[$m];
                } else {
                    $a = $monthData[$m];
                }

                $totalEnglishDays++;
                $day++;

                if ($totalEnglishDays > $a) {
                    $m++;
                    $totalEnglishDays = 1;
                    if ($m > 12) {
                        $y++;
                        $m = 1;
                    }
                }

                if ($day > 7) {
                    $day = 1;
                }

                $total_nDays--;
            }

            $numDay = $day;

            $nepDate = new DateVO();
            $nepDate->year = $y;
            $nepDate->month = $m;
            $nepDate->date = $totalEnglishDays;
            $nepDate->day = Days::getTitle($day);
            $nepDate->nmonth = English::getTitle($m);
            $nepDate->numDay = $numDay;

            return (array) $nepDate;
        }
    }

    /**
     * currently can only calculate the date between AD 1944-2033...
     *
     * @param int $year Year
     * @param int $month Month
     * @param int $date Date
     * @return array Converted Nepali Date for the supplied English Date
     * @throws CalendarException CalendarExceptions
     */
    public function englishToNepali($year, $month, $date)
    {
        // Check for date range
        $chk = English::isValidRange($year, $month, $date);

        if ($chk !== TRUE) {
            throw new CalendarException(CalendarMessages::E_OUT_OF_RANGE, $year, $month, $date);
        } else {
            // Month data.
            $monthData = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

            // Month for leap year
            $lmonth = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

            $def_eyy = 1944;    // initial english date.
            $def_nyy = 2000;
            $def_nmm = 9;
            $def_ndd = 17 - 1;  // inital nepali date.
            $total_eDays = 0;
            $day = 7 - 1;

            // Count total no. of days in-terms year
            for ($i = 0; $i < ($year - $def_eyy); $i++) //total days for month calculation...(english)
            {
                if ($this->isLeapYear($def_eyy + $i) === TRUE) {
                    for ($j = 0; $j < 12; $j++) {
                        $total_eDays += $lmonth[$j];
                    }
                } else {
                    for ($j = 0; $j < 12; $j++) {
                        $total_eDays += $monthData[$j];
                    }
                }
            }

            // Count total no. of days in-terms of month
            for ($i = 0; $i < ($month - 1); $i++) {
                if ($this->isLeapYear($year) === TRUE) {
                    $total_eDays += $lmonth[$i];
                } else {
                    $total_eDays += $monthData[$i];
                }
            }

            // Count total no. of days in-terms of date
            $total_eDays += $date;


            $i = 0;
            $j = $def_nmm;
            $total_nDays = $def_ndd;
            $m = $def_nmm;
            $y = $def_nyy;

            // Count nepali date from array
            while ($total_eDays != 0) {
                $a = $this->_bs[$i][$j];

                $total_nDays++;     //count the days
                $day++;             //count the days interms of 7 days

                if ($total_nDays > $a) {
                    $m++;
                    $total_nDays = 1;
                    $j++;
                }

                if ($day > 7) {
                    $day = 1;
                }

                if ($m > 12) {
                    $y++;
                    $m = 1;
                }

                if ($j > 12) {
                    $j = 1;
                    $i++;
                }

                $total_eDays--;
            }

            $numDay = $day;

            $nepDate = new DateVO();
            $nepDate->year = $y;
            $nepDate->month = $m;
            $nepDate->date = $total_nDays;
            $nepDate->day = Days::getTitle($day);
            $nepDate->nmonth = Nepali::getTitle($m);
            $nepDate->numDay = $numDay;

            return (array)$nepDate;
        }
    }


}