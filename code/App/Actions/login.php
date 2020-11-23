<?php

use App\DB\DB;
use App\Repositories\ListRepository;
use App\TaskList;
use App\Repositories\UsersRepository;
use App\User;
use App\App;

session_start();

$config_path = $_SERVER['DOCUMENT_ROOT'] . "/config.php";
App::bind('config', require $config_path);
$db = new DB(App::get('config')['database']);
$UsersRep = new UsersRepository($db->getInstance(App::get('config')['database']));

if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'check-enter-user') {
        $password = hash('MD5', $_POST['password']);
        if($UsersRep->find($_POST['login'], $password)) {
            $_SESSION['user_login'] = $_POST['login'];
            $UserInfo = [
                'login' => $_SESSION['user_login'],
                'password' => $password
            ];
            $CurrentUser = new User($UserInfo);
            header("Location: http://php-docker.com:9070/?action=enter-user");
        }else{
            header("Location: http://php-docker.com:9070/?action=signup-user");
        }
        exit();

    }
}

require 'google-login.php';

require getcwd() . '/partials/user_form.php';