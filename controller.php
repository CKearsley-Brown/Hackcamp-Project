<?php
session_start();

// Login button Pressed
if (isset($_POST["loginbutton"])) {

    if (false) {
        $_SESSION["login"] = $_POST["userID"];
    } else {
        $_SESSION["error"] = "userID or Password is incorrect.";
    }
}

// Logs the user out of the system
if (isset($_POST["logoutbutton"]))
{
    unset($_SESSION["login"]);
    session_destroy();
}
