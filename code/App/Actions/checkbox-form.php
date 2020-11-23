<?php

use App\Repositories\ListRepository;
use App\DB\DB;
use App\App;

$config_path = $_SERVER['DOCUMENT_ROOT'] . "/config.php";
App::bind('config', require $config_path);
$db = new DB(App::get('config')['database']);
$TaskRep = new ListRepository($db->getInstance(App::get('config')['database']));
$TaskRep->MarkDone($_POST['done']);

header("Location: http://php-docker.com:9070/?action=enter-user");
