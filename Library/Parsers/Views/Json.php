<?php


namespace Library\Parsers\Views;


use Library\Parsers\ViewInterface;
use Library\Utilities\JsonUtils;

/**
 * Class Json
 * @package Library\Parsers\Views
 */
class Json implements ViewInterface
{
    private $data;

    /**
     * Json constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     *
     */
    public function show()
    {
        echo JsonUtils::encode($this->data);
    }
}