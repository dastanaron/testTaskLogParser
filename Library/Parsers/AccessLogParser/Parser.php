<?php

namespace Library\Parsers\AccessLogParser;

use Library\Parsers\ParserHandlerInterface;
use Library\Parsers\ParserInterface;
use Library\Parsers\HandlerInterface;
use Library\Utilities\FileUtils;
use Library\Utilities\StringUtils;

/**
 * Class Parsers
 * @package Library\Parsers
 */
class Parser implements ParserInterface, ParserHandlerInterface
{
    const PATTERN = '#(\S+) (\S+) (\S+) \[([^:]+):(\d+:\d+:\d+) ([^\]]+)\] \"(\S+) (.*?) (\S+)\" (\S+) (\S+) (\".*?\") (\".*?\")#';

    /**
     * @var FileUtils
     */
    protected $file;

    /**
     * @var HandlerInterface
     */
    protected $handler;

    /**
     * Parser constructor.
     * Данному парсеру необходим обработчик данных, так как требуется построчная обработка.
     * Далее только обработчик решает что делать с этими данными
     * @param string $filePath
     * @param HandlerInterface $handler
     */
    public function __construct(string $filePath, HandlerInterface $handler)
    {
        $this->file = new FileUtils($filePath);
        $this->handler = $handler;
    }

    /**
     * Можно изменить обработчик, таким образом, при перезапуске метода parse() мы можем получить данные в другом интересующем виде
     * @param HandlerInterface $handler
     * @return $this
     */
    public function setHandler(HandlerInterface $handler)
    {
        $this->handler = $handler;
        return $this;
    }

    /**
     * Только парсит и отдает обработчику, обработчик потом вернет подсчитанные данные
     */
    public function parse()
    {
        foreach ($this->file->readFileByLine(1024) as $string) {

            $matchedData = StringUtils::pregMatch(self::PATTERN, $string);

            $logData = new LogData($matchedData);

            $this->handler->addData($logData);
        }
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->handler->getData();
    }
}