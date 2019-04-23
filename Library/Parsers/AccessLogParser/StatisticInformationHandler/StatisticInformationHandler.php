<?php

namespace Library\Parsers\AccessLogParser\StatisticInformationHandler;


use Library\Parsers\LogDataInterface;
use Library\Parsers\AccessLogParser\LogData;
use Library\Parsers\HandlerInterface;
use Library\Utilities\ArrayUtils;
use Library\Utilities\StringUtils;

/**
 * Class StatisticInformationHandler
 * @package Library\Parsers\AccessLogParser\StatisticInformationHandler
 */
class StatisticInformationHandler implements HandlerInterface
{

    /**
     * @var array
     */
    private $views = [];

    /**
     * @var array
     */
    private $urls = [];

    /**
     * @var array
     */
    private $referers = [];

    /**
     * @var int
     */
    private $traffic = 0;

    /**
     * @var array
     */
    private $crawlers = [];

    /**
     * @var array
     */
    private $statusCodes = [];

    /**
     * @var array
     */
    private $data = [];

    /**
     * @param LogDataInterface|LogData $data
     */
    public function addData(LogDataInterface $data)
    {
        if(!ArrayUtils::hasInArray($data->ipAddress, $this->views)) {
            $this->views[] = $data->ipAddress;
        }

        if(!ArrayUtils::hasInArray($data->requestString, $this->urls)) {
            $this->urls[] = $data->requestString;
        }

        if(!ArrayUtils::hasInArray($data->referer, $this->referers)) {
            $this->referers[] = $data->referer;
        }

        $this->traffic += $data->answerSize;

        $this->crawlers[] = $data->userAgent;

        $this->statusCodes[] = $data->statusCode;
    }

    /**
     * @return array
     */
    public function getData()
    {
        if(empty($this->data)) {
            return $this->getComputedData();
        }
        else {
            return $this->data;
        }
    }

    /**
     * @return array
     */
    private function getComputedData()
    {
        return [
            'views' => count($this->views),
            'urls'  => count($this->urls),
            'traffic' => $this->traffic,
            'crawlers' => $this->getIdentifyCrawlers(),
            'statusCodes' => $this->getComputedStatusCodes()
        ];
    }

    /**
     * @return array
     */
    private function getComputedStatusCodes()
    {
        $tempArray = [];

        $resultStatusCodes = [];

        foreach($this->statusCodes as $statusCode) {
            if(!ArrayUtils::hasInArray($statusCode, $tempArray)) {
                $tempArray[] = $statusCode;
                $resultStatusCodes[$statusCode] = 1;
            }
            else {
                $resultStatusCodes[$statusCode]++;
            }
        }

        return $resultStatusCodes;
    }

    /**
     * Вот этот метод конечно не красивый, но я все равно точно не знаю, как эти боты обозначаются,
     * Нужен лог с представленными ботами, чтобы посмотреть вариации их userAgent и учесть их.
     * @return array
     */
    private function getIdentifyCrawlers()
    {
        $googleAgentPattern = "#googlebot#i";
        $googleBotCount = 0;

        $bingAgentPattern = "#bingbot#i";
        $bingBotCount = 0;

        $baiduAgentPattern = "#baidubot#i";
        $baiduBotCount = 0;

        $yandexAgentPattern = "#yandexbot#i";
        $yandexBotCount = 0;

        foreach($this->crawlers as $userAgent) {
            if(!empty(StringUtils::pregMatch($googleAgentPattern, $userAgent))) {
                $googleBotCount++;
            }
            if(!empty(StringUtils::pregMatch($bingAgentPattern, $userAgent))) {
                $bingBotCount++;
            }
            if(!empty(StringUtils::pregMatch($baiduAgentPattern, $userAgent))) {
                $baiduBotCount++;
            }
            if(!empty(StringUtils::pregMatch($yandexAgentPattern, $userAgent))) {
                $yandexBotCount++;
            }
        }

        $results = [
            'Google' => $googleBotCount,
            'Bing' => $bingBotCount,
            'Baidu' => $baiduBotCount,
            'Yandex' => $yandexBotCount
        ];

        return $results;
    }
}