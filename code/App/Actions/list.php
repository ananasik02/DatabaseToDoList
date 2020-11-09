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

if(!isset($_GET['page'])){
    $page = 1;
}else{
    $page = $_GET['page'];
}

$thisPageFirstResult = ($page-1) * $itemsPerPage;

for($page=1; $page <= $numberOfPages; $page++){
    echo '<a href="index.php?page=' . $page .' "> ' .$page . '</a>';
}

$listOfTasks = $taskRep->all($userId, $thisPageFirstResult, $itemsPerPage) ;
include $_SERVER['DOCUMENT_ROOT'] .  '/partials/view_tasklist.php';


?>
