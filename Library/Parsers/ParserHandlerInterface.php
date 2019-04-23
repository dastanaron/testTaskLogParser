<?php


namespace Library\Parsers;

/**
 * Interface ParserHandlerInterface
 * Интерфейс для парсеров, у которых есть обработчик спарсенных данных
 * @package Library\Parser
 */
interface ParserHandlerInterface
{
    public function setHandler(HandlerInterface $handler);
}