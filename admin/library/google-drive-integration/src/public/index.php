<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use src\controllers\DriveController;

session_start();

$controller = new DriveController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller->fetchFiles();
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
?>