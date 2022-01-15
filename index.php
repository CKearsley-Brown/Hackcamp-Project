<?php

$view = new stdClass();
$view->pageTitle = 'Index';

require_once('Models/Users.php');
$user = new User();
$_SESSION['user'] = $user;

// Login button Pressed
if (isset($_POST["loginbutton"])) {

    require_once('Models/UserData.php');

    // Collect username and password for checking with password_verify
    if (isset($_POST["loginButton"]))
    {
        $user->AttemptLoginUser($_POST["email"],$_POST["password"]);
    }
}

require_once('controller.php');
require_once('Views/index.phtml');