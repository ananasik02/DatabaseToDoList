<?php

namespace App\Controllers;

use App\DB\DB;
use App\Repositories\UsersRepository;
use App\Repositories\ListRepository;

class CreateTaskController
{
    public $UsersRep;
    public $TaskRep;

    public function __construct()
    {
        $this->UsersRep = new UsersRepository(DB::getInstance());
        $this->TaskRep = new ListRepository(DB::getInstance());
    }

    public static function index()
    {
        $CreateTasksCtrl = new static;
        $listOfUsers = $CreateTasksCtrl->UsersRep->all();
        require $_SERVER['DOCUMENT_ROOT'] . '/../App/views/task_form.php';
    }

    public static function create()
    {
        $CreateTasksCtrl = new static;
        $CreateTasksCtrl->TaskRep->create($_POST);
        header("Location: http://php-docker.local:8080/list");
    }
}