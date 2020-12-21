<?php

session_start();

use App\DB\DB;
use App\Repositories\ListRepository;
use App\Repositories\UsersRepository;

$UsersRep = new UsersRepository(DB::getInstance());

$password = hash('MD5', $_POST['password']);
$User =[
    'login' => $_POST['login'],
    'password' => $password
];
$UsersRep->create($User);
$_SESSION['user_login'] = $_POST['login'];


require $_SERVER['DOCUMENT_ROOT'] . '/../App/views/user_signup_form.php';



