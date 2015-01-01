# Introduction of the Repository [![Build Status](https://travis-ci.org/FiveDotsSoft/Nepali-Date-Converter.svg?branch=master)](https://travis-ci.org/FiveDotsSoft/Nepali-Date-Converter)

This repository contains the PHP code that can be used to convert date from Nepali-English and vice versa.
 
This is basically a rewrite and code structuring of the Nepali_Calendar.php class from Aman Tuladhar [Aman Github Link].

I basically made it composer ready and added few tests cases. I have also added the code coverage so anyone trying to
make use of this library may find it helpful.

# Year Supported
Range: 1944-2022 (AD)

# How to install it?

Add the below code on `require` section of your `composer.json` file.
 
```
 "require": {
      "fivedots/nepalicalendar":"*"
 }
```

After adding the above require statement, run `composer update`. 

# How to use it?
### Refer to `example.php` file 

```
 <?php
 require __DIR__.'/vendor/autoload.php';

 $calendar = new Fivedots\NepaliCalendar\Calendar();

 // Get English to Nepali converted date
 print_r($calendar->englishToNepali(2015,1,1));

 // Get Nepali to English converted date
 print_r($calendar->nepaliToEnglish(2071,9,17));

```    

Hope this helps someone.

[Aman Github Link]:https://github.com/amant/Nepali-Date-Convert/blob/master/php/nepali_calendar.php