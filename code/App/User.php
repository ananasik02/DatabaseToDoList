<?php

namespace App;

class User{
    private $id;
    public $login;
    public $password;

    function __construct(array  $userData)
    {
        $this->login = isset($userData['login']) ? $userData['login'] : '';
        $this->password = isset($userData['password']) ? $userData['password'] : '';
    }
}