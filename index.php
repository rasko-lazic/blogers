<?php

use App\Router;
use Core\Session;

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

// Autoload function that takes into account namespace and class containing uppercase letters
// Method taken from PSR-O standard https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}
spl_autoload_extensions('.php');
spl_autoload_register('autoload');



$session = new Session();
$router = new Router();
