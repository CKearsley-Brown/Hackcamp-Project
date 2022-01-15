<?php

$view = new stdClass();
$view->pageTitle = 'Index';

// Login button Pressed
if (isset($_POST["loginbutton"])) {
    require_once('Models/UserDataSet.php');

    AttemptLoginUser($_POST["email"], $_POST["password"]);
}

require_once('controller.php');
require_once('Views/index.phtml');