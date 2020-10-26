<?php

namespace App\DB;

use PDO;

class DB{
    private static $instance = null;
    private $server = 'db';
    private $database = 'tasklist';
    private $user = 'root';
    private $password = 'Vitalik*love23';
    private $connection;
    
    private function __construct()
    {
        $this->connection = new PDO("mysql:host=$this->server;port=3306;dbname=$this->database", $this->user, $this->password);
    }

    public static function getInstance()
    {
        if(self::$instance) {
            return self::$instance;
        }

        return self::$instance = new self();
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function query(string $preperedStatement, array $args =[])
    {
        $stmt = $this->connection->prepare($preperedStatement);
        $stmt->execute($args);
        return $stmt;
    }

    public function getLastInsertedId()
    {
        return $this->connection->lastInsertId();
    }
}