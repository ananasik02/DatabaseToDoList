<?php require  $_SERVER['DOCUMENT_ROOT'] . '/../partials/header.php';?>
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

                            <form action="/create" enctype="multipart/form-data" method="POST">

                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter task" hidden="true" id="task" name="id"  value="<?php if($task_id) echo $task_id ?> " required>
                                </div>
                                <div class="form-group">
                                    <label for="task">Task:</label>
                                    <input class="form-control" placeholder="Enter task" id="task" name="task"
                                           value="<?php if($currentTask->task) echo $currentTask->task?> " required>
                                </div>
                                <div class="form-group">
                                    <label for="performer">PM:</label>
                                    <p><select size="3" multiple id="PM" name="PM" value=" ">
                                            <option disabled>Enter PM</option>
                                            <?php foreach ($listOfUsers as $user) : ?>
                                                <option value="<?php echo $user->login ?>"> <?php  echo $user->login  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="performer">Performer:</label>
                                    <p><select size="3" multiple id="performer" name="performer"  value=" ">
                                            <option disabled>Enter performer</option>
                                            <?php foreach ($listOfUsers as $user) : ?>
                                                <option value="<?php echo $user->login ?>"> <?php  echo $user->login  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="price">Deadline:</label>
                                    <input type="date" class="form-control" placeholder="Enter deadline" id="deadline"
                                           name="deadline" required value=" <?php if($currentTask->deadline) echo $currentTask->deadline?>  ">
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require  $_SERVER['DOCUMENT_ROOT'] . '/../partials/footer.php' ?>