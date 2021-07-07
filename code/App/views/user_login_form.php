<?php require  $_SERVER['DOCUMENT_ROOT'] . '/../partials/header.php';?>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">

                            <form action="/login " enctype="multipart/form-data" method="POST">
                                <div class="form-group">
                                    <label for="task">Login:</label>
                                    <input class="form-control" placeholder="Enter login" id="login" name="login" required>
                                </div>
                                <div class="form-group">
                                    <label for="performer">Password:</label>
                                    <input class="form-control" placeholder="Enter password" id="password" name="password" required></input>
                                </div>
                                <button type="submit" class="btn btn-success">Log in or Sign up</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require  $_SERVER['DOCUMENT_ROOT'] . '/../partials/footer.php' ?>