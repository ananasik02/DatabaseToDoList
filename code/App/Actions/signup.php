<?php

session_start();

use App\DB\DB;
use App\Repositories\ListRepository;
use App\Repositories\UsersRepository;
use App\App;

$config_path = $_SERVER['DOCUMENT_ROOT'] . "/config.php";
App::bind('config', require $config_path);
$db = new DB(App::get('config')['database']);
$UsersRep = new UsersRepository($db->getInstance(App::get('config')['database']));

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
        header("Location: http://php-docker.com:9070/?action=enter-user");
        exit();
    }
}

require getcwd() . '/partials/user_form.php';
?>