<?php
session_start();
use App\DB\DB;
use App\Repositories\ListRepository;
use App\Repositories\UsersRepository;
use App\TaskList;
use App\UserList;
require __DIR__ . '/vendor/autoload.php';
use Carbon\Carbon;

include  $_SERVER['DOCUMENT_ROOT'] . '/App/Repositories/ListRepository.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/Repositories/UsersRepository.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/DB/DB.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/TaskList.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/UserList.php';

$TaskRep = new ListRepository(DB::getInstance());
$list = new TaskList($TaskRep);

$listOfTasks = $list->getTasks();

$today=date("d/m/y");
$now = Carbon::now();
//echo "$now\n";

require 'partials/view_tasklist.php';
?>
