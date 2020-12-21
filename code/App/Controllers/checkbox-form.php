<?php

use App\Repositories\ListRepository;
use App\DB\DB;

$TaskRep = new ListRepository(DB::getInstance());
$TaskRep->MarkDone($_POST['done']);

header("Location: http://php-docker.local:9070/?action=enter-user");


