<?php

namespace App;

use App\Repositories\ListRepository;
use App\DB\DB;
use App\Repositories\UsersRepository;
use App\UserList;

$UserRep = new UsersRepository(DB::getInstance());
$users = new UserList($UserRep);
$listOfUsers = $users->getUsers();

$task_id=$_POST['id'];
$TaskRep = new ListRepository(DB::getInstance());
$currentTask=$TaskRep->find($task_id);


if (isset($_GET['action'])) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'save-updated-task') {
        $TaskRep = new ListRepository(DB::getInstance());
        $newPM = $TaskRep->finduserId($_POST['PM']);
        $newPerformer = $TaskRep->finduserId($_POST['performer']);
        $UpdatedTask=[
          'id' => intval($_POST['id']),
          'task' => htmlentities($_POST['task']),
          'PM' => intval($newPM),
          'performer' => intval($newPerformer),
          'deadline' => htmlentities($_POST['deadline'])
        ];
        $TaskRep->update($UpdatedTask);
        header("Location: http://php-docker.local:9070/?action=enter-user");
        exit();
    }
}

require 'partials/task_form.php';

?>
