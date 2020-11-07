<?php require 'header.php';
//echo $pagePath;
?>
    <div class="container">
        <div class="card">
            <div class="card-header">
        <?php if($pagePath =='/code/App/Actions/create.php') : ?>
            <h3>Create Task:</h3>
        <?php endif; ?>
        <?php if($pagePath =='/code/App/Actions/update.php') : ?>
            <h3>Update Task:</h3>
        <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <?php if($pagePath =='/code/App/Actions/create.php') : ?>
                                <form action="?action=save-task" enctype="multipart/form-data" method="POST" class="create-artifact">
                            <?php endif; ?>
                            <?php if($pagePath =='/code/App/Actions/update.php') : ?>
                                <form action="?action=save-updated-task" enctype="multipart/form-data" method="POST" class="create-artifact">
                            <?php endif; ?>
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
                                        </select></p>
                                </div>
                                <div class="form-group">
                                    <label for="performer">Performer:</label>
                                    <p><select size="3" multiple id="performer" name="performer"  value=" ">
                                            <option disabled>Enter performer</option>
                                            <?php foreach ($listOfUsers as $user) : ?>
                                                <option value="<?php echo $user->login ?>"> <?php  echo $user->login  ?></option>
                                            <?php endforeach; ?>
                                        </select></p>
                                </div>
                                <div class="form-group">
                                    <label for="price">Deadline:</label>
                                    <input type="date" class="form-control" placeholder="Enter deadline" id="deadline"
                                           name="deadline" required value=" <?php if($currentTask->deadline) echo $currentTask->deadline?>  ">
                                </div>
                                <?php if($pagePath =='/code/App/Actions/create.php') : ?>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                <?php endif; ?>
                                <?php if($pagePath =='/code/App/Actions/update.php') : ?>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require 'footer.php'?>