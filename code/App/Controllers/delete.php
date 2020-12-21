<?php
namespace App;
use App\Repositories\ListRepository;
use App\DB\DB;


$TaskRep = new ListRepository(DB::getInstance());
if($_POST['id']) {
    $TaskRep->remove($_POST['id']);
}

header("Location: http://php-docker.local:9070/?action=enter-user");
