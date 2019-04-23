<?php

define('ROOT_DIRECTORY', __DIR__);

require_once ROOT_DIRECTORY . '/Library/autoload.php';

$filePath = $argv[1];

$handler = new \Library\Parsers\AccessLogParser\StatisticInformationHandler\StatisticInformationHandler();

$parser = new \Library\Parsers\AccessLogParser\Parser($filePath, $handler);

$parser->parse();

$parsedData = $parser->getData();

$view = new \Library\Parsers\Views\Json($parsedData);

$view->show();