<?php

use app\Router;
use core\Session;

// Error bootstrap
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conversion of errors into exceptions
// https://www.php.net/manual/en/language.exceptions.php
set_error_handler('exceptions_error_handler');
function exceptions_error_handler($severity, $message, $filename, $lineno) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
}

set_include_path('/var/www/blogers/App');
spl_autoload_extensions('.php');
spl_autoload_register();

$session = new Session();

$router = new Router();

exit();