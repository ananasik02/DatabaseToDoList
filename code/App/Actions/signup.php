<?php

session_start();

use App\DB\DB;
use App\Repositories\ListRepository;
use App\TaskList;
use App\Repositories\UsersRepository;

include  $_SERVER['DOCUMENT_ROOT'] . '/App/Repositories/ListRepository.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/DB/DB.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/TaskList.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/Repositories/UsersRepository.php';

$UsersRep = new UsersRepository(DB::getInstance());

if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'create-user') {
        $password = hash('ripemd160', $_POST['password']);
        $User =[
            'login' => $_POST['login'],
            'password' => $password
        ];
        $UsersRep->create($User);
        $_SESSION['user_login'] = $_POST['login'];
        header("Location: http://php-docker.local:9070/list.php");
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
                        <form action="?action=create-user" enctype="multipart/form-data" method="POST" class="create-artifact">
                            <div class="form-group">
                                <label for="task">Login:</label>
                                <input class="form-control" placeholder="Enter login" id="login" name="login" required>
                            </div>
                            <div class="form-group">
                                <label for="performer">Password:</label>
                                <input class="form-control" placeholder="Enter password" id="password" name="password" required></input>
                            </div>
                            <button type="submit" class="btn btn-success">Create account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>