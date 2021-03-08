<?php

session_start();

include dirname(__DIR__) . '/vendor/autoload.php';
$request = new \App\services\Request();

//$request->getException();

$controllerName = $request->getControllerName() ?: 'user';
$actionName = $request->getActionName();


new \Twig\Loader\FilesystemLoader();

$controllerClass = 'App\\controllers\\' . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(
        new \App\services\renders\TwigRender(),
        $request
    );
    echo $controller->run($actionName);
}