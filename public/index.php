<?php
use \App\modules\Good;
session_start();

include dirname(__DIR__) . '/services/Autoload.php';
spl_autoload_register([new Autoload(), 'loadClass']);

$controllerName = $_GET['c'] ?: 'user';

$actionName = '';
if (!empty($_GET['a'])) {
    $actionName = $_GET['a'];
}

$controllerClass = 'App\\controllers\\' . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    $controller = new $controllerClass;
    echo $controller->run($actionName);
}