<?php

namespace App;
use App\DB\DB;
use App\Repositories\ListRepository;
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use Carbon\Carbon;
use DateTime;

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

    public function calculateTimeLeft()
    {
        $startTime = new DateTime();
        $finishTime=new DateTime($this->deadline);
        $timeleft = $startTime->diff($finishTime, true);
        echo $timeleft->d . "d " . $timeleft->h . "h " . $timeleft ->i . "m ";
        return $timeleft;
    }

    public function isCompleted() : string
    {
        $attHtml = "";

        if($this->completed==1){
            $attHtml .= '<p>Yes</p>';
        }else{

            $attHtml .='<p>No</p>
                <form action="?action=check-box" method="post">
                    <input type="checkbox" name="done" value="' . $this->id .
                ' " />
                    <input type="submit" name="formSubmit" hidden="true" value=" " </form> ';
        }

        return $attHtml;
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