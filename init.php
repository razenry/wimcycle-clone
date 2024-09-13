<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_wimcycle');

// Autoload Core Libraries
spl_autoload_register(function ($class) {

    $corePath       = __DIR__ . '/app/core/' . $class . '.php';
    $helperPath     = __DIR__ . '/helpers/' . $class . '.php';
    $databasePath   = __DIR__ . '/database/' . $class . '.php';

    if (file_exists($corePath)) {
        require_once $corePath;
    } 

    elseif (file_exists($helperPath)) {
        require_once $helperPath;
    }

    elseif (file_exists($databasePath)) {
        require_once $databasePath;
    }

});

