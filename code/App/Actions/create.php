<?php
namespace App;
use App\Repositories\ListRepository;
use App\DB\DB;
use App\Repositories\UsersRepository;
use App\UserList;

$UserRep = new UsersRepository(DB::getInstance());
$users = new UserList($UserRep);
$listOfUsers = $users->getUsers();

if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'save-task') {
        $TaskRep = new ListRepository(DB::getInstance());
        $TaskRep->create($_POST);
        header("Location: http://php-docker.local:9070/?action=enter-user");
        exit();
    }
}

require 'partials/task_form.php';
?>
