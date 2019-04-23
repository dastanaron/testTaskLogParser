<?php


namespace Library\Parsers;

/**
 * Interface ParserInterface
 * Универсальный интерфейс парсера
 * @package Library\Parser
 */
interface ParserInterface
{
    /**
     * Любой парсер должен уметь парсить
     * @return mixed
     */
    public function parse();

    /**
     * Любой парсер должен уметь отдавать распарсенные данные
     * @return mixed
     */
    public function getData();
}