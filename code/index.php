<?php
session_start();
require 'vendor/autoload.php';

phpinfo();


$router = Router::load('routes.php');
$pageName = $router->direct('login');



$requestURL = ($_SERVER['REQUEST_URI']);
$requestURL = explode('%', $requestURL);
$requestURL = $requestURL[0];
if($requestURL == '/?page' ){
    $pageName = $router->direct('list');
}

if (isset($_GET['action'])) {
    $requestedPage = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
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
    }elseif($requestedPage == 'logout-user'){
        $pageName = $router->direct('logout');
    }else{
        var_dump($requestedPage);
    }
}
$pagePath = $_SERVER['DOCUMENT_ROOT'] . $pageName;
include $pagePath;