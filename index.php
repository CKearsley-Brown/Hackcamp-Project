<?php
require_once('controller.php');

$view = new stdClass();
$view->pageTitle = 'Index';

unset($_SESSION["loginError"]);

// Collect username and password for checking with password_verify
if (isset($_POST["loginbutton"]))
{
    if (!$_SESSION['user']->AttemptLoginUser($_POST["email"],$_POST["password"]))
    {
        $_SESSION["loginError"] = "Incorrect Email or Password.";
    }
}

require_once('Views/index.phtml');