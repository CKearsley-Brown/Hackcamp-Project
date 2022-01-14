<?php

$view = new stdClass();
$view->pageTitle = 'Index';

// Login button Pressed
if (isset($_POST["loginbutton"])) {

    require_once('Models/UserDataSet.php');

    // Collect username and password for checking with password_verify
    $userDataSet = new UserDataSet();
    $view->userDataSet = $userDataSet->checkUserCredentials($_POST["email"], $_POST["password"]);

    if (!empty($view->userDataSet)) {
        $_SESSION["login"] = $_POST["userID"];
    } else {
        $_SESSION["error"] = "userID or Password is incorrect.";
    }
}

require_once('controller.php');
require_once('Views/index.phtml');