<?php
session_start();
use App\DB\DB;
use App\Repositories\ListRepository;
use App\Repositories\UsersRepository;
use App\UserList;
use App\Task;

$taskRep = new ListRepository(DB::getInstance());

$userLogin = $_SESSION['user_login'];
$userId=$taskRep->finduserId($userLogin);
$listOfTasks = $taskRep->all($userId) ;

include $_SERVER['DOCUMENT_ROOT'] .  '/partials/view_tasklist.php';
?>
