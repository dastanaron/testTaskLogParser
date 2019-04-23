<?php


namespace Library\Utilities;

class DateTimeHelper
{

    public static function parseDateFromLogFormat($date, $time, $timezone, $dateFormat = 'd/M/Y H:i:s')
    {
        $parsedDate = date_parse_from_format($dateFormat, $date . $time);

        $dateToIsoFormat = "";

    }

}