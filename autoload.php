<?php declare(strict_types=1);

spl_autoload_register(function ($className) {
    $file = __DIR__ . '/application/';
    $file .= str_replace('\\', '/', $className) . '.php';

    if (!is_file($file)) {        
        return false;
    }

    require_once $file;
    return true;
});
