<?php


namespace Library\Parsers\AccessLogParser;

use Library\Parsers\LogDataInterface;

/**
 * Class LogData
 * @package Library\Parsers
 */
class LogData implements LogDataInterface
{
    public $ipAddress;
    public $dateTime;
    public $requestType;
    public $requestString;
    public $protocol;
    public $statusCode;
    public $answerSize;
    public $referer;
    public $userAgent;

    /**
     * LogData constructor.
     * @param array $array
     * @param string $dateTimeParseFormat
     */
    public function __construct(array $array, $dateTimeParseFormat = "d/M/Y H:i:s O")
    {
        $this->ipAddress = $array[1];
        $this->dateTime = $this->dateTimeFormat($array[4], $array[5], $array[6], $dateTimeParseFormat);
        $this->requestType = $array[7];
        $this->requestString = $array[8];
        $this->protocol = $array[9];
        $this->statusCode = $array[10];
        $this->answerSize = $array[11];
        $this->referer = $array[12];
        $this->userAgent = $array[13];
    }

    /**
     * @param $date
     * @param $time
     * @param $timezone
     * @return bool|\DateTime
     */
    private function dateTimeFormat($date, $time, $timezone, $format)
    {
        $parsedDate = \DateTime::createFromFormat($format, "{$date} {$time} {$timezone}");

        return $parsedDate;
    }


}