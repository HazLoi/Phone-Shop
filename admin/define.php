<?php
include_once 'library/smarty/Smarty.class.php';
$st = new Smarty();

$models = __DIR__.'/class';
$routeFiles = scandir($models);

foreach ($routeFiles as $routeFile) {
    $routeFilePath = $models . '/' . $routeFile;
    if (is_file($routeFilePath) && preg_match('/^.*\.(php)$/i', $routeFilePath))
        require_once $routeFilePath;
}

include_once '#directthumuc/config.php';