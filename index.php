<?php

$view = new stdClass();
$view->pageTitle = 'Index';

require_once('Models/User.php');
$user = new User();
$_SESSION['user'] = $user;

// Login button Pressed
if (isset($_POST["loginbutton"]))
{
    //var_dump($_POST);
    // try and log a user in
    $user->AttemptLoginUser($_POST["email"],$_POST["password"]);
    //var_dump($_SESSION["login"]);


}

require_once('controller.php');
require_once('Views/index.phtml');