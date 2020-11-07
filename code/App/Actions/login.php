<?php

use App\DB\DB;
use App\Repositories\ListRepository;
use App\TaskList;
use App\Repositories\UsersRepository;
use App\User;

$UsersRep = new UsersRepository(DB::getInstance());

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
            header("Location: http://php-docker.local:9070/?action=enter-user");
        }else{
            header("Location: http://php-docker.local:9070/?action=signup-user");
        }
        exit();

    }
}


require getcwd() . '/partials/user_form.php';