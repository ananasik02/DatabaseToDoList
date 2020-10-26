<?php

namespace App\Repositories;

use App\DB\DB;
use PDO;

class UsersRepository
{
    private $db;
    private $table = 'users';

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function find($login, $password)
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE login = ? LIMIT 1", [$login]);
        //var_dump($stmt->fetch(PDO::FETCH_OBJ));
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create(array $UserInfo)
    {
        $sql = "INSERT INTO {$this->table} (login, password)
                VALUES (:login, :password)";

        $data = [
            ':login' => htmlentities($UserInfo['login']),
            ':password' => htmlentities($UserInfo['password'])

        ];

        $this->db->query($sql, $data);

        $createdUserId = $this->db->getLastInsertedId();

        return $createdUserId;
    }

}