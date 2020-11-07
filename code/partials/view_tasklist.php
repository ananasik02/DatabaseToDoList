<?php require 'header.php';  ?>
<div class="container">
    <p>
    <form style="display: inline-block" action="?action=create-task" method="post">
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
            <th>Time Left</th>
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
                    <td style="color: #c15d2a"><?php $item->calculateTimeLeft(); ?></td>
                    <td><?php echo $item->isCompleted(); ?> </td>
                    <td>
                        <form style="display: inline-block" action="?action=delete-task" method="post">
                            <input type="hidden" name="id" value="<?php echo $item->id?>">
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                    <td>
                        <form style="display: inline-block" action="?action=update-task" method="post">
                            <input type="hidden" name="id" value="<?php echo $item->id?>">
                            <?php $_SESSION['taskid']=$item->id?>
                            <button class="btn btn-sm btn-outline-success">Update</button>
                        </form>
                    </td>


                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require 'footer.php' ?>