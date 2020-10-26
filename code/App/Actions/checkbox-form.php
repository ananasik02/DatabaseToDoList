<?php

use App\Repositories\ListRepository;
use App\DB\DB;
include  $_SERVER['DOCUMENT_ROOT'] . '/App/Repositories/ListRepository.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/DB/DB.php';

$TaskRep = new ListRepository(DB::getInstance());
$TaskRep->MarkDone($_POST['formSubmit']);

header("Location: http://php-docker.local:9070/list.php");

var_dump($_POST['formSubmit']);

