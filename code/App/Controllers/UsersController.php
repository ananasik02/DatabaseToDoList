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
            echo "i'm logged";
        }else{
           UsersController::SignUp();
        }
    }

    public static function SignUp()
    {
        $UsersCntrl = new static;
        $password = hash('MD5', $_POST['password']);
        $User =[
            'login' => $_POST['login'],
            'password' => $password
        ];
        $UsersCntrl->UsersRep->create($User);
        $_SESSION['user_login'] = $_POST['login'];
    }
}