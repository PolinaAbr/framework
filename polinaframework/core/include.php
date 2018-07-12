<?php

spl_autoload_register(function ($class) {
    $file = $_SERVER['DOCUMENT_ROOT'] . '/' . $class . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

require "core.php";
$application = Polinaframework\Core\Application::getInstance();
$application->includeFile($application->getCorePath()."/core/constants.php");
$application->includeFile($application->getCorePath()."/php_interface/init.php");

function debug($arr) {
    echo '<pre>' . print_r($arr, true) . '</pre>';
//    echo '<pre>' . var_export($arr, true) . '</pre>';
}