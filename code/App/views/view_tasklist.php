<?php require 'header.php'; ?>
<div class="container">
    <p>
    <form style="display: inline-block" action="?action=create-task" method="post">
        <button class= "btn btn-success">Create Task</button>
    </form>
    </p>
    <p>
            Show
        <form style="display: inline-block;" action="?action=choose-number" method="post">
            <button class="btn btn-sm btn btn-light" name="itemsPerPage" value="5">5</button>
        </form>
        <form style="display: inline-block;" action="?action=choose-number" method="post">
            <button class="btn btn-sm btn btn-light" name="itemsPerPage" value="10">10</button>
        </form>
        <form style="display: inline-block;" action="?action=choose-number" method="post">
            <button class="btn btn-sm btn btn-light" name="itemsPerPage" value="all">All</button>
        </form>
            tasks
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
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    for($page=1; $page <= $numberOfPages; $page++): ?>
        <form style="display: inline-block" action="?action=set-page" method="post">
            <button class="btn btn-sm btn btn-light" name="page" value="<?php echo $page?>"><?= $page ?></button>
        </form>

    <?php endfor; ?>
</div>

<?php require 'footer.php' ?>