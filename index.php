<?php
session_start();
require_once './Model/Connection.php';

$pdoBuilder = new Connection();
$db = $pdoBuilder->getDb();

$ctrl = isset($_GET['ctrl']) ? ucfirst(preg_replace('/[^a-zA-Z]/', '', $_GET['ctrl'])) : 'Category';
$action = isset($_GET['action']) ? preg_replace('/[^a-zA-Z]/', '', $_GET['action']) : 'display';

$controllerFile = "./Controller/{$ctrl}Controller.php";

if (!file_exists($controllerFile)) {
    http_response_code(404);
    exit('404 Not found');
}

require_once $controllerFile;
$className = $ctrl . 'Controller';

if (!class_exists($className)) {
    http_response_code(404);
    exit('404 Not found');
}

$controller = new $className($db);

if (!method_exists($controller, $action)) {
    http_response_code(404);
    exit('404 Not found');
}

$controller->$action();