<?php

/**
 * Самый простейший автолоадер, чтобы не подключать сложный композеровский
 * Позволяет подключать классы где пространство имен совпадает с расположением
 */
spl_autoload_register(function ($class) {

    $classPath = str_replace('\\', '/', $class);

    require_once ROOT_DIRECTORY . '/' . $classPath . '.php';
});