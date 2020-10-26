<?php

namespace App;

class User{
    private $id;
    public $login;
    public $password;

    function __construct(array  $userData)
    {
        $this->login = isset($data['login']) ? $data['login'] : '';
        $this->password = isset($data['password']) ? $data['password'] : '';
    }
}