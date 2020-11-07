<?php require 'header.php';
//echo $_SERVER['REQUEST_URI'];
//echo $pagePath;
?>
    <div class="container">
        <div class="card">

            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                        <?php if($pagePath =='/code/App/Actions/signup.php') : ?>
                            <form action="?action=create-user" enctype="multipart/form-data" method="POST" class="create-artifact">
                        <?php endif; ?>
                        <?php if($pagePath=='/code/App/Actions/login.php') : ?>
                            <form action="?action=check-enter-user" enctype="multipart/form-data" method="POST" class="create-artifact">
                        <?php endif; ?>
                                <div class="form-group">
                                    <label for="task">Login:</label>
                                    <input class="form-control" placeholder="Enter login" id="login" name="login" required>
                                </div>
                                <div class="form-group">
                                    <label for="performer">Password:</label>
                                    <input class="form-control" placeholder="Enter password" id="password" name="password" required></input>
                                </div>
                                <input class="form-control" hidden="yes" name="page" value="list.php" required></input>
                                <?php if($pagePath =='/code/App/Actions/login.php') : ?>
                                <button type="submit" class="btn btn-success">Log in</button>
                                <?php endif; ?>
                                <?php if($pagePath =='/code/App/Actions/signup.php') : ?>
                                    <button type="submit" class="btn btn-success">Create user</button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require 'footer.php' ?>