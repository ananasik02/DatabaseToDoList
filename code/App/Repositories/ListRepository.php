<?php

namespace App\Repositories;

use App\Task;
use App\DB\DB;
use PDO;


class ListRepository{
    private $db;
    private $table = 'tasks';
    private $linkedtable = 'users';

    public function __construct(DB $db){
        $this->db = $db;
    }

    public function all($userId, $startResult, $resultsNumber)
    {
        $sql = "SELECT * FROM {$this->table} WHERE performer = {$userId} ||
            PM = {$userId} LIMIT {$startResult},{$resultsNumber}";
        $stmt = $this->db->query($sql);
        $tasksData = $stmt->fetchAll();
        $tasksCollection = $this->mapTasks($tasksData);
        return $tasksCollection;

    }

    public function getRowsCount($userId)
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE performer = {$userId} || PM = ? ", [$userId]);
        $number_of_rows = $stmt->rowCount();
        return $number_of_rows;
    }

    public function find(int $id)
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE id = ? LIMIT 1", [$id]);
        $oneTask = $stmt->fetchAll();
        $findTask = $this->mapOneTask($oneTask);
        return $findTask;
    }

    public function MarkDone(int $id)
    {
        $stmt = $this->db->query("UPDATE {$this->table} SET completed=1 WHERE id = ? ", [$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update(array $newInfo)
    {
        $sql = "UPDATE {$this->table} SET task = :task, PM = :PM,
                 performer = :performer, deadline = :deadline
                WHERE id={$newInfo['id']}";

        $data = [
            ':task' => htmlentities($newInfo['task']),
            ':PM' => $newInfo['PM'],
            ':performer' => $newInfo['performer'],
            ':deadline' => htmlentities($newInfo['deadline'])

        ];
        $this->db->query($sql, $data);
        //echo "I am here";
        return $newInfo['id'];
    }



    public function findlinks(int $id)
    {
        $stmt = $this->db->query("SELECT login FROM {$this->linkedtable} WHERE id = ? LIMIT 1", [$id]);
        $infoArray=$stmt->fetch();
        return $infoArray['login'];
    }

    public function finduserId($login)
    {
        $stmt = $this->db->query("SELECT id FROM {$this->linkedtable} WHERE login = ? LIMIT 1", [$login]);
        $infoArray=$stmt->fetch();
        return $infoArray['id'];
    }

    public function create(array $TaskInfo)
    {
        $sql = "INSERT INTO {$this->table} (task, PM, performer, deadline, completed)
                VALUES (:task, :PM, :performer, :deadline, :completed)";

        $data = [
            ':task' => htmlentities($TaskInfo['task']),
            ':PM' => $this->finduserId($TaskInfo['PM']),
            ':performer' => $this->finduserId($TaskInfo['performer']),
            ':deadline' => htmlentities($TaskInfo['deadline']),
            ':completed' => 0

        ];
        $this->db->query($sql, $data);

        $createdTaskId = $this->db->getLastInsertedId();
        return $createdTaskId;
    }

    public function remove(int $id)
    {
        return $this->db->query("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    private function mapTasks(array $tasks): array
    {
        $taskCollection = [];
        foreach ($tasks as $task) {
            $task['task'] = html_entity_decode($task['task']);
            $task['PM'] = html_entity_decode($task['PM']);
            $task['performer'] = html_entity_decode($task['performer']);
            $task['deadline'] = html_entity_decode($task['deadline']);
            $task['completed'] = $task['completed'];
            $taskCollection[] = new Task($task);
        }

        return $taskCollection;
    }
    private function mapOneTask( array $OneTasks)
    {
        $task['task'] = html_entity_decode($OneTasks[0]['task']);
        $task['PM'] = intval($OneTasks[0]['PM']);
        $task['performer'] = intval($OneTasks[0]['performer']);
        $task['deadline'] = html_entity_decode($OneTasks[0]['deadline']);
        $task['completed'] = $OneTasks[0]['completed'];
        $findtask = new Task($task);
        return $findtask;
    }
}