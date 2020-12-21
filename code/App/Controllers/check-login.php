<?php

echo "I've got it";
$UsersRep = new UsersRepository(DB::getInstance());

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
    echo "Bitch, i do not exist";
    Router::get('/signup');
    //header("Location: http://php-docker.local:9070/?action=signup-user");
}