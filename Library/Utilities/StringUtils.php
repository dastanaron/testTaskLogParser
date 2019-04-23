<?php


namespace Library\Utilities;

/**
 * Class StringUtils
 * В данный клас необходимо внести все необходимые методы для работы со строками
 * @see https://github.com/roistat/php-code-conventions (Общие правила)
 * @package Library\Utilities
 */
class StringUtils
{
    /**
     * @param $pattern
     * @param $subject
     * @return array
     */
    public static function pregMatch(string $pattern, $subject) : array
    {
        $matches = [];
        preg_match($pattern, $subject, $matches);
        return $matches;
    }
}