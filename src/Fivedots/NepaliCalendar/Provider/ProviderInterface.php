<?php
/**
 * Created by PhpStorm.
 * User: broncha
 * Date: 7/29/15
 * Time: 11:17 AM
 */

namespace Fivedots\NepaliCalendar\Provider;

interface ProviderInterface {
    public function getData($year);

    public function isValidDate($year, $month, $date);
}