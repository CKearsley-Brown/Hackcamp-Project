<?php

$view = new stdClass();
$view->pageTitle = 'Index';

// Login button Pressed
if (isset($_POST["loginbutton"])) {

    require_once('Models/UserDataSet.php');

    $userDataSet = new UserDataSet();

    if (!empty($view->userDataSet)) {
        $_SESSION["login"] = $_POST["email"];
    } else {
        $_SESSION["error"] = "Email or Password is incorrect.";
    }
}

require_once('controller.php');
require_once('Views/index.phtml');