<?php
use App\Controllers\UsersController;
if($_POST)
{
   UsersController::checkLogin();
}
else{
    require $_SERVER['DOCUMENT_ROOT'] . '/../App/views/user_login_form.php';
}


