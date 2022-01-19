<?php

require_once('Models/User.php');
require_once('Models/UserData.php');
require_once('Models/UserDataSet.php');
$user = new User();
$_SESSION['user'] = $user;

$userTableDataSet = new UserDataSet();

// Logs the user out of the system
if (isset($_POST["logoutbutton"]))
{
    unset($_SESSION["user_id"]);
    unset($_SESSION["login"]);
    session_destroy();
    $user = new User();
    $_SESSION['user'] = $user;
}
