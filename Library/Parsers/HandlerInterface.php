<?php


namespace Library\Parsers;

/**
 * Interface HandlerInterface
 * Интерфейс для обработчиков данных парсера
 * @package Library\Parsers
 */
interface HandlerInterface
{
    /**
     * @param LogDataInterface $data
     * @return mixed
     */
    public function addData(LogDataInterface $data);

    /**
     * @return mixed
     */
    public function getData();
}