<?php

use App\DB\DB;
use App\Repositories\ListRepository;
use App\TaskList;
use App\Repositories\UsersRepository;
use App\User;

$UsersRep = new UsersRepository(DB::getInstance());
//
//var_dump($_REQUEST);

echo "Bitch, i'm here";

        $password = hash('MD5', $_POST['password']);
        if($UsersRep->find($_POST['login'], $password)) {
            $_SESSION['user_login'] = $_POST['login'];
            $UserInfo = [
                'login' => $_SESSION['user_login'],
                'password' => $password
            ];
            $CurrentUser = new User($UserInfo);
            //Route::get('/list', '/../App/Actions/list.php');
            //header("Location: http://php-docker.local:9070/l");
            echo "Bitch, i'm logged in";
        }else{
            //header("Location: http://php-docker.local:9070/?action=signup-user");
        }
        exit();


//require getcwd() . '/../partials/user_form.php';