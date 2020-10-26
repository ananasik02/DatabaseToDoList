<?php

namespace App;

use App\DB\DB;
use App\Repositories\ListRepository;

class Task
{
    public $id;
    public $task;
    public $PM;
    public $performer;
    public $deadline;
    public $completed;

    public function __construct(array $data){
        $this->id = isset($data['id']) ? $data['id'] : '';
        $this->task = isset($data['task']) ? $data['task'] : '';
        $this->deadline = isset($data['deadline']) ? $data['deadline'] : '';
        $this->completed = isset($data['completed']) ? $data['completed'] : '';

        $TaskRep = new ListRepository(DB::getInstance());
        $setPM=$TaskRep->findlinks(intval($data['PM']));
        $setPerformer=$TaskRep->findlinks(intval($data['performer']));
        $this->PM = $setPM;
        $this->performer = $setPerformer;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'task' =>$this->task,
            'PM' => $this->PM,
            'performer' => $this->performer,
            'deadline' => $this->deadline,
            'completed' => $this->completed
        ];
    }
}