<?php

session_start();

use App\DB\DB;
use App\Repositories\ListRepository;
use App\TaskList;
use App\Repositories\UsersRepository;
use App\User;

include  $_SERVER['DOCUMENT_ROOT'] . '/App/Repositories/ListRepository.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/DB/DB.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/TaskList.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/Repositories/UsersRepository.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/User.php';

$UsersRep = new UsersRepository(DB::getInstance());

if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'enter-user') {
        $password = hash('ripemd160', $_POST['password']);
        if($UsersRep->find($_POST['login'], $password)) {
            $_SESSION['user_login'] = $_POST['login'];
            $UserInfo = [
                'login' => $_SESSION['user_login'],
                'password' => $password
            ];
            $CurrentUser = new User($UserInfo);
            header("Location: http://php-docker.local:9070/list.php");
        }else{
            header("Location: http://php-docker.local:9070/App/Actions/signup.php");
        }
        exit();

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="example">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title></title>
</head>
<body>
<div class="container">
    <div class="card">

        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="?action=enter-user" enctype="multipart/form-data" method="POST" class="create-artifact">
                            <div class="form-group">
                                <label for="task">Login:</label>
                                <input class="form-control" placeholder="Enter login" id="login" name="login" required>
                            </div>
                            <div class="form-group">
                                <label for="performer">Password:</label>
                                <input class="form-control" placeholder="Enter password" id="password" name="password" required></input>
                            </div>
                            <button type="submit" class="btn btn-success">Log in</button>

                        </form>
                        <form action="App/Actions/signup.php">
                            <button type="submit" class="btn btn-primary">Sign up</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>