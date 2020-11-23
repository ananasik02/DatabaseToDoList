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

$task_id=$_POST['id'];

$config = require($_SERVER['DOCUMENT_ROOT'] . "/config.php");
$config = $config['database'];
$db = new DB($config);
$TaskRep = new ListRepository($db->getInstance($config));
$currentTask=$TaskRep->find($task_id);


if (isset($_GET['action'])) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'save-updated-task') {
        $config_path = $_SERVER['DOCUMENT_ROOT'] . "/config.php";
        $TaskRep = new ListRepository($db->getInstance(App::get('config')['database']));
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
        header("Location: http://php-docker.com:9070/?action=enter-user");
        exit();
    }
}

require 'partials/task_form.php';

?>