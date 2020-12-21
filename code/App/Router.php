<?php

namespace App;
class Router
{
    protected $routes = [
        '' => 'index.php',
        '/login' => '/../App/Controllers/login.php',
        '/signup' => '/../App/Controllers/signup.php',
        '/check-login' => '/../App/Controllers/check-login.php',
        'list' => '../App/Controllers/list.php',
        'create' => '../App/Controllers/create.php',
        'delete' => '../App/Controllers/delete.php',
        'update' => '../App/Controllers/update.php',
        'check-box' => '../App/Controllers/checkbox-form.php'
    ];

    public static function get($uri)
    {
        $router = new static;
        if (array_key_exists($uri, $router->routes)) {
            require $_SERVER['DOCUMENT_ROOT'] . $router->routes[$uri];
            return 0;
        }

    }

}