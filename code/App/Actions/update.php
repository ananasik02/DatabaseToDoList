<?php

namespace App;

use App\Repositories\ListRepository;
use App\DB\DB;
use App\Repositories\UsersRepository;
use App\UserList;

include getcwd() . '/../Repositories/ListRepository.php';
include getcwd() . '/../DB/DB.php';
include getcwd() . '/../TaskList.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/Repositories/UsersRepository.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/App/UserList.php';

$UserRep = new UsersRepository(DB::getInstance());
$users = new UserList($UserRep);
$listOfUsers = $users->getUsers();

$task_id=$_POST['id'];
$TaskRep = new ListRepository(DB::getInstance());
$currentTask=$TaskRep->find($task_id);


if (isset($_GET['action'])) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'update-task') {
        $TaskRep = new ListRepository(DB::getInstance());
        $newPM = $TaskRep->finduserId($_POST['PM']);
        $newPerformer = $TaskRep->finduserId($_POST['performer']);
        $UpdatedTask=[
          'id' => intval($_POST['id']),
          'task' => htmlentities($_POST['task']),
          'PM' => intval($newPM),
          'performer' => intval($newPerformer),
          'deadline' => htmlentities($_POST['deadline'])
        ];
        $TaskRep->update($UpdatedTask);
        header("Location: http://php-docker.local:9070/list.php");
        exit();
    }
}



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="example">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title></title>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Update Task:</h3>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="?action=update-task" enctype="multipart/form-data" method="POST"
                              class="create-artifact">
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter task" hidden="true" id="task" name="id"  value="<?php echo $task_id?>" required>
                            </div>
                            <div class="form-group">
                                <label for="task">Task:</label>
                                <input class="form-control" placeholder="Enter task" id="task" name="task"  value="<?php echo $currentTask->task  ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="performer">PM:</label>
                                <p><select size="3" multiple id="PM" name="PM" value="<?php echo $currentTask->PM  ?>">
                                        <option disabled>Enter PM</option>
                                        <?php foreach ($listOfUsers as $user) : ?>
                                            <option value="<?php echo $user->login ?>"> <?php  echo $user->login  ?></option>
                                        <?php endforeach; ?>
                                    </select></p>
                            </div>
                            <div class="form-group">
                                <label for="performer">Performer:</label>
                                <p><select size="3" multiple id="performer" name="performer"  value="<?php echo $currentTask->performer  ?>">
                                        <option disabled>Enter performer</option>
                                        <?php foreach ($listOfUsers as $user) : ?>
                                            <option value="<?php echo $user->login ?>"> <?php  echo $user->login  ?></option>
                                        <?php endforeach; ?>
                                    </select></p>
                            </div>
                            <div class="form-group">
                                <label for="price">Deadline:</label>
                                <input type="date" class="form-control" placeholder="Enter deadline" id="deadline"
                                       name="deadline" required value="<?php echo $currentTask->deadline ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>