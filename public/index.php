<?php

session_start();

include dirname(__DIR__) . '/vendor/autoload.php';
include dirname(__DIR__) . '/services/Autoload.php';
spl_autoload_register([new Autoload(), 'loadClass']);

$controllerName = $_GET['c'] ?: 'user';

$actionName = '';
if (!empty($_GET['a'])) {
    $actionName = $_GET['a'];
}

new \Twig\Loader\FilesystemLoader();

$controllerClass = 'App\\controllers\\' . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new \App\services\renders\TwigRender());
    echo $controller->run($actionName);
}