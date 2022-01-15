<?php

$view = new stdClass();
$view->pageTitle = 'Index';

require_once('Models/User.php');
require_once('Models/UserData.php');
$user = new User();
$_SESSION['user'] = $user;

// Collect username and password for checking with password_verify
if (isset($_POST["loginbutton"]))
{
    $user->AttemptLoginUser($_POST["email"],$_POST["password"]);
}


require_once('controller.php');
require_once('Views/index.phtml');