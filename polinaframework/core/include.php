<?php
use polinaframework\core\Application;

spl_autoload_register(function ($class) {
    $file = dirname(dirname(__DIR__)) . '/' . $class . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

require "core.php";
$application = Application::getInstance();
$application->includeFile($application->corePath."/php_interface/init.php");