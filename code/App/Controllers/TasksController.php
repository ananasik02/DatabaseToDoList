<?php

namespace App\Controllers;

use App\DB\DB;
use App\Repositories\ListRepository;
use App\Repositories\UsersRepository;
use App\UserList;
use App\Task;
use App\Controllers\CreateTaskController;

class TasksController
{
    public $TasksRep;

    public function __construct()
    {
        $this->TasksRep = new ListRepository(DB::getInstance());
    }

    public static function index()
    {
        $TaskCtrl = new static;
        $userLogin = $_SESSION['user_login'];
        $userId=$TaskCtrl->TasksRep->finduserId($userLogin);
        $listOfTasks = $TaskCtrl->TasksRep->all($userId, 1, 7) ;
        require $_SERVER['DOCUMENT_ROOT'] . '/../App/views/view_tasklist.php';
    }

}