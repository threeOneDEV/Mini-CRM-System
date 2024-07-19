<?php

namespace app;

use controllers\auth\AuthController;
use controllers\contacts\ContactController;
use controllers\home\HomeController;
use controllers\offers\OfferController;
use controllers\products\ProductController;
use controllers\tasks\TaskController;
use controllers\users\UserController;

class Router{
    private $routes;

    public function __construct(){
        $this->routes = [
            '/^\/?$/' => ['controller' => 'home\\HomeController', 'action' => 'index'],
            '/^\/users(\/(?P<action>[a-zA-Z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'users\\UserController'],
            '/^\/tasks(\/(?P<action>[a-zA-Z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'tasks\\TaskController'],
            '/^\/login(\/(?P<action>[a-zA-Z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'auth\\AuthController'],
            '/^\/contacts(\/(?P<action>[a-zA-Z]+)(\/(?P<id_first>\d+)(\/(?P<id_second>\d+))?)?)?$/' => ['controller' => 'contacts\\ContactController'],
            '/^\/offers(\/(?P<action>[a-zA-Z]+)(\/(?P<id_first>\d+)(\/(?P<id_second>\d+))?)?)?$/' => ['controller' => 'offers\\OfferController'],
            '/^\/profile(\/(?P<action>[a-zA-Z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'profile\\ProfileController'],
            '/^\/products(\/(?P<action>[a-zA-Z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'products\\ProductController'],
            '/^\/archive(\/(?P<action>[a-zA-Z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'archive\\ArchiveController']
        ];
    }




    public function run(){
        $uri = $_SERVER['REQUEST_URI'];
        $controller = '';
        $action = '';
        $params = [];

        foreach ($this->routes as $pattern => $route) {
            if (preg_match($pattern, $uri, $matches)) {
                $controller = "controllers\\" . $route['controller'];
                $action = $route['action'] ?? $matches['action'] ?? 'index';
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                break;
            }
        }

        if (!$controller){
            http_response_code(404);
            echo 'page not found';
            return;
        }

        $controllerInstance = new $controller();

        if (!method_exists($controllerInstance, $action)) {
            http_response_code(404);
            echo 'page not found';
            return;
        }

        call_user_func_array([$controllerInstance, $action], [$params]);
    }
}