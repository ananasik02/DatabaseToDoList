<?php

namespace App;

class Router
{

    protected $routes = [
        '' => '/../App/Controllers/index.php',
        '/login' => [
            'name' => 'App\Controllers\UsersController',
            'method' => 'index'
            ],
        '/list' => [
            'name' => 'App\Controllers\TasksController',
            'method' => 'index'
        ],
        '/task/create' => [
            'name' => 'App\Controllers\CreateTaskController',
            'method' => 'index'
        ],
        'create' => '../App/Controllers/create.php',
        'delete' => '../App/Controllers/delete.php',
        'update' => '../App/Controllers/update.php',
        'check-box' => '../App/Controllers/checkbox-form.php'
    ];

    public static function get($uri)
    {
        $router = new static;

        if (array_key_exists($uri, $router->routes)) {
            $class = $router->routes[$uri]['name'];
            $method = $router->routes[$uri]['method'];
            $class::$method();
            return ;
        }

    }


}