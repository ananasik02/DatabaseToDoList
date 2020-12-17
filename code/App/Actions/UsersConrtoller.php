<?php


namespace App\Actions;
use App\Repositories\UsersRepository;
use App\DB\DB;

class UsersConrtoller
{
    protected  $UsersRep;

    public function setRep()
    {
        $this->UsersRep = new UsersRepository(DB::getInstance());
    }

    public function checkUser()
    {
       
    }

    public function create()
    {
        $password = hash('MD5', $_POST['password']);
        $User =[
            'login' => $_POST['login'],
            'password' => $password
        ];
        $this->UsersRep->create($User);
        $_SESSION['user'] = $User;
    }
}