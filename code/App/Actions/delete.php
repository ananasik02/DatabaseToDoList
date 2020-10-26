<?php
namespace App;
use App\Repositories\ListRepository;
use App\DB\DB;
include  getcwd() . '/../Repositories/ListRepository.php';
include  getcwd() . '/../DB/DB.php';
include  getcwd() . '/../TaskList.php';

$TaskRep = new ListRepository(DB::getInstance());
if($_POST['id']) {
    $TaskRep->remove($_POST['id']);
}
header("Location: ");
?>