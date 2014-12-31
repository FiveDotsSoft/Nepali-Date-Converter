<?php
require __DIR__.'/vendor/autoload.php';

$calendar = new Fivedots\NepaliCalendar\Calendar();

// Get English to Nepali converted date
print_r($calendar->englishToNepali(2015,1,1));

// Get Nepali to English converted date
print_r($calendar->nepaliToEnglish(2071,9,17));