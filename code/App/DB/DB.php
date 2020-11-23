<?php

namespace App\DB;

use PDO;

class DB{
    private static $instance = null;
    private $server;
    private $database;
    private $user;
    private $password;
    private $connection;

    public function __construct($config)
    {
        $this->server = $config['server'];
        $this->database = $config['name'];
        $this->user = $config['user'];
        $this->password = $config['password'];

        $this->connection = new PDO("mysql:host=$this->server;port=3306;dbname=$this->database", $this->user, $this->password);
    }

    public static function getInstance($config)
    {
        if(self::$instance) {
            return self::$instance;
        }

        return self::$instance = new self($config);
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