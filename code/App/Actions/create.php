<?php
namespace App;
use App\Repositories\ListRepository;
use App\DB\DB;
include  getcwd() . '/../Repositories/ListRepository.php';
include  getcwd() . '/../DB/DB.php';
include  getcwd() . '/../TaskList.php';

if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'save-task') {
        $TaskRep = new ListRepository(DB::getInstance());
        $TaskRep->create($_POST);
        header("Location: http://php-docker.local:9070");
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title></title>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Create Task:</h3>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="?action=save-task" enctype="multipart/form-data" method="POST" class="create-artifact">
                            <div class="form-group">
                                <label for="task">Task:</label>
                                <input class="form-control" placeholder="Enter task" id="task" name="task" required>
                            </div>
                            <div class="form-group">
                                <label for="performer">PM:</label>
                                <input class="form-control" placeholder="Enter performer" id="PM" name="PM" required></input>
                            </div>
                            <div class="form-group">
                                <label for="performer">Performer:</label>
                                <input class="form-control" placeholder="Enter performer" id="performer" name="performer" required></input>
                            </div>
                            <div class="form-group">
                                <label for="price">Deadline:</label>
                                <input type="date" class="form-control" placeholder="Enter deadline" id="deadline" name="deadline" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>