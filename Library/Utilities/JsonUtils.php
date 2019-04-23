<?php


namespace Library\Utilities;


class JsonUtils
{

    /**
     * @param array $data
     * @param int|null $options
     * @return false|string
     */
    public static function encode(array $data, int $options = null)
    {
        return json_encode($data, $options);
    }

    /**
     * @param string $jsonString
     * @param bool $associative
     * @param int $depth
     * @param int|null $options
     * @return mixed
     */
    public static function decode(string $jsonString, $associative = true, int $depth = 512, int $options = null)
    {
        return json_decode($jsonString, $associative, $depth, $options);
    }
}