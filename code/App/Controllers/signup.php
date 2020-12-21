<?php
use App\Controllers\UsersController;
if($_POST)
{
    UsersController::SignUp();
}
else{
    require $_SERVER['DOCUMENT_ROOT'] . '/../App/views/user_signup_form.php';
}




