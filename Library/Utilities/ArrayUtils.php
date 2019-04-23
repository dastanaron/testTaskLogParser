<?php


namespace Library\Utilities;

/**
 * Class ArrayUtils
 * @package Library\Utilities
 */
class ArrayUtils
{
    /**
     * @param $needle
     * @param $haystack
     * @param bool $strict
     * @return bool
     */
    public static function hasInArray($needle, $haystack, $strict = false)
    {
        return in_array($needle, $haystack, $strict);
    }
}