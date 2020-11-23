<?php
namespace App;
use App\Repositories\ListRepository;
use App\DB\DB;
use App\Repositories\UsersRepository;
use App\UserList;
use App\App;

$config_path = $_SERVER['DOCUMENT_ROOT'] . "/config.php";
App::bind('config', require $config_path);
$db = new DB(App::get('config')['database']);
$UserRep = new UsersRepository($db->getInstance(App::get('config')['database']));
$users = new UserList($UserRep);
$listOfUsers = $users->getUsers();

if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'save-task') {
        $TaskRep = new ListRepository($db->getInstance(App::get('config')['database']));
        $TaskRep->create($_POST);
        header("Location: http://php-docker.com:9070/?action=enter-user");
        exit();
    }
}

require 'partials/task_form.php';
?>