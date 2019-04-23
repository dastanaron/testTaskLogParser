<?php

namespace Library\Parsers\AccessLogParser\StatisticInformationHandler;

use Library\Parsers\Handlers\HandlerData;

class Data implements HandlerData
{
    public function toArray(): array
    {
        return [];
    }
}

/*
 * {
  views: 16,
  urls: 5,
  traffic: 187990,
  crawlers: {
      Google: 2,
      Bing: 0,
      Baidu: 0,
      Yandex: 0
  },
  statusCodes: {
      200 : 14,
      301 : 2
  }
}
 */