<?php
session_start();
require 'vendor/autoload.php';
$pageName = 'login.php';
$requestedPage = $_SERVER['REQUEST_URI'];
if (isset($_GET['action'])) {
    $requestedPage = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($requestedPage == 'enter-user') {
        $pageName = 'list.php';
    }
    elseif($requestedPage == 'create-task'  || $requestedPage == 'save-task' ){
        $pageName = 'create.php';
    }elseif($requestedPage == 'update-task' || $requestedPage == 'save-updated-task'){
        $pageName = 'update.php';
    }
    elseif($requestedPage == 'check-enter-user'){
        $pageName = 'login.php';
    }
    elseif($requestedPage == 'check-box'){
        $pageName = 'checkbox-form.php';
    }
    elseif($requestedPage == 'delete-task'){
        $pageName = 'delete.php';
    }
    elseif($requestedPage == 'signup-user' || $requestedPage='create-user'){
        $pageName = 'signup.php';
    }else {
        $pageName = $requestedPage;
    }
}

$pagePath = $_SERVER['DOCUMENT_ROOT'] . "/App/Actions/$pageName";
include $pagePath;


?>
