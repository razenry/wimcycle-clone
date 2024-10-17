<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'wimcycle');
define('API_KEY', 'access');

// Autoload Core Libraries
spl_autoload_register(function ($class) {

    $corePath       = __DIR__ . '/app/core/' . $class . '.php';
    $modelsPath       = __DIR__ . '/app/models/' . $class . '.php';
    $helperPath     = __DIR__ . '/helpers/' . $class . '.php';
    $databasePath   = __DIR__ . '/database/' . $class . '.php';
    $apiPath   = __DIR__ . '/app/api/' . $class . '.php';

    if (file_exists($corePath)) {
        require_once $corePath;
    } 

    elseif (file_exists($modelsPath)) {
        require_once $modelsPath;
    }

    elseif (file_exists($helperPath)) {
        require_once $helperPath;
    }

    elseif (file_exists($databasePath)) {
        require_once $databasePath;
    }

    elseif (file_exists($apiPath)) {
        require_once $apiPath;
    }

});

