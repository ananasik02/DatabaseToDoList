<?php

namespace App\Controllers;

use App\Repositories\UsersRepository;
use App\DB\DB;
use App\User;

class UsersController
{
    public $UsersRep;

    public function __construct()
    {
        $this->UsersRep = new UsersRepository(DB::getInstance());
    }

    public static function index()
    {
        if($_POST){
            UsersController::checkLogin();
        } else{
            require $_SERVER['DOCUMENT_ROOT'] . '/../App/views/user_login_form.php';
        }
    }

    public static function checkLogin()
    {
        $UsersCntrl = new static;
        $password = hash('MD5', $_POST['password']);
        if($UsersCntrl->UsersRep->find($_POST['login'], $password)) {
            $_SESSION['user_login'] = $_POST['login'];
            $UserInfo = [
                'login' => $_SESSION['user_login'],
                'password' => $password
            ];
            $CurrentUser = new User($UserInfo);
            header("Location: http://php-docker.local:8080/list");
        }else{
           UsersController::createUser();
        }
    }

    public static function createUser()
    {
        $UsersCntrl = new static;
        $password = hash('MD5', $_POST['password']);
        $User =[
            'login' => $_POST['login'],
            'password' => $password
        ];
        $UsersCntrl->UsersRep->create($User);
        $_SESSION['user_login'] = $_POST['login'];
        header("Location: http://php-docker.local:8080/list");
    }
}