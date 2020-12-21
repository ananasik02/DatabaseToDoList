<?php
session_start();
use App\DB\DB;
use App\Repositories\ListRepository;
use App\Repositories\UsersRepository;
use App\UserList;
use App\Task;

require $_SERVER['DOCUMENT_ROOT'] . "/App/Repositories/ListRepository.php";


$taskRep = new ListRepository(DB::getInstance());
$pageName ='App/Actions/list.php';
$userLogin = $_SESSION['user_login'];
$userId=$taskRep->finduserId($userLogin);

$numberOfItems = $taskRep->getRowsCount($userId);
$page=1;
$itemsPerPage = 7;


$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$action = explode("?", $action);

if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    $action = explode("?", $action);
    $action = $action[0];
    if ($action == 'set-page') {
        if($_POST){
            $page = $_POST['page'];

        }else{
            $page=1;
        }
        //echo $page;
        $thisPageFirstResult = ($page-1) * $itemsPerPage;
        $listOfTasks = $taskRep->all($userId, $thisPageFirstResult, $itemsPerPage) ;
        header("Location: http://php-docker.local:9070/?page = {$page}");

    }
    if($action == 'choose-number'){
        $_SESSION['itemsPerPage'] = $_POST['itemsPerPage'];
        //$itemsPerPage = $_SESSION['itemsPerPage'];
    }
}
else{
    $page = intval($_REQUEST['page_']);
}

if(isset($_SESSION['itemsPerPage'])){
    $itemsPerPage = $_SESSION['itemsPerPage'];
    if($_SESSION['itemsPerPage']=='all'){
        $itemsPerPage=$numberOfItems;
    }
}
$numberOfPages = ceil($numberOfItems/$itemsPerPage);
$thisPageFirstResult = ($page-1) * $itemsPerPage;
$listOfTasks = $taskRep->all($userId, $thisPageFirstResult, $itemsPerPage) ;
include $_SERVER['DOCUMENT_ROOT'] .  '/partials/view_tasklist.php';



