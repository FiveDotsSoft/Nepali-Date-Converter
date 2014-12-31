<?php
namespace Fivedots\NepaliCalendar\Month;
//use Fivedots\NepaliCalendar\Month\MonthInterface;
class Nepali implements MonthInterface
{
    const BAISAKH = 1;
    const JESTHA = 2;
    const ASHAR = 3;
    const SHRAWAN = 4;
    const BHADRA = 5;
    const ASHOJ = 6;
    const KARTIK = 7;
    const MANGSHIR = 8;
    const POUSH = 9;
    const MAGH = 10;
    const FALGUN = 11;
    const CHAITRA = 12;

    protected static $months = array(
        self::BAISAKH => 'Baisakh', self::JESTHA => 'Jestha',
        self::ASHAR => 'Ashar', self::SHRAWAN => 'Shrawan',
        self::BHADRA => 'Bhadra', self::ASHOJ => 'Ashoj',
        self::KARTIK => 'Kartik', self::MANGSHIR => 'Mangshir',
        self::POUSH => 'Poush', self::MAGH => 'Magh',
        self::FALGUN => 'Falgun', self::CHAITRA => 'Chaitra'
    );

    public static function getTitle($index)
    {
        return self::$months[$index];
    }

    /**
     * Check if date is with in nepali data range
     *
     * @param int $yy
     * @param int $mm
     * @param int $dd
     * @return bool
     */
    public static function isValidRange($yy, $mm, $dd)
    {
        if ($yy < 2000 || $yy > 2089) {
            return 'Supported only between 2000-2089';
        }

        if ($mm < 1 || $mm > 12) {
            return 'Error! month value can be between 1-12 only';
        }

        if ($dd < 1 || $dd > 32) {
            return 'Error! day value can be between 1-31 only';
        }

        return TRUE;
    }
}