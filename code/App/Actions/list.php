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

$numberOfItems = $taskRep->getRowsCount($userId);
$itemsPerPage=8;
$numberOfPages = ceil($numberOfItems/$itemsPerPage);

$page = 1;


$thisPageFirstResult = ($_POST['page']-1) * $itemsPerPage;

$listOfTasks = $taskRep->all($userId, $thisPageFirstResult, $itemsPerPage) ;
include $_SERVER['DOCUMENT_ROOT'] .  '/partials/view_tasklist.php';


?>
