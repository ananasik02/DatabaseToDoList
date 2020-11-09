<?php

session_start();

use App\DB\DB;
use App\Repositories\ListRepository;
use App\Repositories\UsersRepository;

$UsersRep = new UsersRepository(DB::getInstance());

if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'create-user') {
        $password = hash('MD5', $_POST['password']);
        $User =[
            'login' => $_POST['login'],
            'password' => $password
        ];
        $UsersRep->create($User);
        $_SESSION['user_login'] = $_POST['login'];
        header("Location: http://php-docker.local:9070/?action=enter-user");
        exit();
    }
}

require getcwd() . '/partials/user_form.php';
?>


