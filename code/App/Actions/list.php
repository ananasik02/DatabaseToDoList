<?php
session_start();
use App\DB\DB;
use App\Repositories\ListRepository;
use App\Repositories\UsersRepository;
use App\UserList;
use App\Task;
use App\App;

$config_path = $_SERVER['DOCUMENT_ROOT'] . "/config.php";
App::bind('config', require $config_path);
$db = new DB(App::get('config')['database']);
$taskRep = new ListRepository($db->getInstance(App::get('config')['database']));

$pageName ='App/Actions/list.php';
$userLogin = $_SESSION['user_login'];
$userId=$taskRep->finduserId($userLogin);

$numberOfItems = $taskRep->getRowsCount($userId);
$page=1;
$itemsPerPage = 7;

$numberOfPages = ceil($numberOfItems/$itemsPerPage);
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
        header("Location: http://php-docker.com:9070/?page = {$page}");

    }
}
else{
    $page = intval($_REQUEST['page_']);
}

$thisPageFirstResult = ($page-1) * $itemsPerPage;

$listOfTasks = $taskRep->all($userId, $thisPageFirstResult, $itemsPerPage) ;
include $_SERVER['DOCUMENT_ROOT'] .  '/partials/view_tasklist.php';
