<?php
session_start();
use App\DB\DB;
use App\Repositories\ListRepository;
use App\TaskList;

include  $_SERVER['DOCUMENT_ROOT'] . '/App/Repositories/ListRepository.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/DB/DB.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/TaskList.php';

$TaskRep = new ListRepository(DB::getInstance());
$list = new TaskList($TaskRep);

$listOfTasks = $list->getTasks();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="example">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title></title>
</head>
<body>

<div class="container">
    <p>
    <form style="display: inline-block" action="App/Actions/create.php" method="post">
        <button class= "btn btn-success">Create Task</button>
    </form>
    </p>
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Task</th>
            <th>PM</th>
            <th>Performer</th>
            <th>Deadline</th>
            <th>Done</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($listOfTasks as $item) : ?>
        <?php if($item->PM==$_SESSION['user_login'] || $item->performer==$_SESSION['user_login']):?>
            <tr>
                <td><?php echo $item->id ?></td>
                <td><?php echo $item->task ?></td>
                <td><?php echo $item->PM ?></td>
                <td><?php echo $item->performer ?></td>
                <td><?php echo $item->deadline ?></td>
                <td>
                    <?php if($item->completed == 1) { ?>
                        <p>Yes</p>
                    <?php } else { ?>
                        <p>No</p>
                        <form action="App/Actions/checkbox-form.php" method="post">
                            <input type="checkbox" name="done" value="no" />
                            <input type="submit" name="formSubmit" hidden="true" value="<?php echo $item->id?>" />
                        </form>
                    <?php } ?>

                </td>
                <td>
                    <form style="display: inline-block" action="App/Actions/delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $item->id?>">
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>

            </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
</body>
</html>