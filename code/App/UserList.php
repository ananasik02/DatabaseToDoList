<?php

namespace App;

use App\DB\DB;
use App\Repositories\UsersRepository;

class UserList{
    public $users = [];
    public $repository;

    public function __construct(UsersRepository $reposiroty){
        $this->repository = $reposiroty;
        $this->loadUsers();
    }

    public function getUsers(){
        return $this->users;
    }

    public function setUsers(array $value){
        $this->users = $value;
    }

    public function loadUsers(){
        $this->users = $this->repository->all();
    }
}