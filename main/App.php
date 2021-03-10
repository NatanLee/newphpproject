<?php

namespace App\main;

use App\repositories\GoodRepository;
use App\repositories\UserRepository;
use App\services\DB;
use App\services\renders\IRender;
use App\services\UserService;
use App\traits\TSingleton;

/**
 * Class App
 * @package App\main
 *
 * @property IRender render
 * @property DB db
 * @property UserRepository userRepository
 * @property GoodRepository goodRepository
 * @property UserService userService
 */
class App
{
    use TSingleton;

    static public function call(): App
    {
        return static::getInstance();
    }

    public $config = [];
    private $components = [];
    /*
     * 'render' => $newRender
     *
     * $App = new App();
     * $App->render
     * */

    public function run(array $config)
    {
        $this->config = $config;
        $this->runController();

    }

    protected function runController()
    {
        $request = new \App\services\Request();

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
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->components)) {
            return $this->components[$name];
        }

        if (!array_key_exists($name, $this->config['components'])) {
            return null;
        }

        $className = $this->config['components'][$name]['class'];

        if (array_key_exists('config', $this->config['components'][$name])) {
            $config = $this->config['components'][$name]['config'];
            $components = new $className($config);
        } else {
            $components = new $className();
        }

        $this->components[$name] = $components;
        return  $components;
    }
}
