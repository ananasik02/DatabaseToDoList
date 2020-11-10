<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/App/Router.php";
require $_SERVER['DOCUMENT_ROOT'] . "/App/Request.php";
$router = Router::load('routes.php');
$pageName = $router->direct('login');

require 'vendor/autoload.php';
if (isset($_GET['action'])) {
    $requestedPage = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    //echo $requestedPage;
    if ($requestedPage == 'enter-user' || $requestedPage == 'set-page' ) {
        $pageName = $router->direct('list');
    }elseif($requestedPage == 'create-task'  || $requestedPage == 'save-task'){
        $pageName = $router->direct('create');
    }elseif ($requestedPage == 'update-task' || $requestedPage == 'save-updated-task'){
        $pageName = $router->direct('update');
    }elseif ($requestedPage == 'check-enter-user'){
        $pageName = $router->direct('login');
    }elseif($requestedPage == 'check-box'){
        $pageName = $router->direct('check-box');
    } elseif($requestedPage == 'delete-task'){
        $pageName = $router->direct('delete');
    }elseif($requestedPage == 'signup-user' || $requestedPage='create-user'){
        $pageName = $router->direct('signup');
    }else{
        var_dump($requestedPage);
    }
}
$pagePath = $_SERVER['DOCUMENT_ROOT'] . $pageName;
include $pagePath;

