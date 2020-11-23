<?php

namespace App;

use App\DB\DB;
use App\Repositories\ListRepository;

class TaskList{
    public $tasks = [];
    public $repository;

    public function __construct(ListRepository $reposiroty){
        $this->repository = $reposiroty;
        $this->loadTasks();
    }

    public function getTasks(){
        return $this->tasks;
    }

    public function setTasks(array $value){
        $this->tasks = $value;
    }

    public function loadTasks(){
        $this->tasks = $this->repository->all();
    }
}