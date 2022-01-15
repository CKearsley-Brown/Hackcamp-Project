<?php


// Logs the user out of the system
if (isset($_POST["logoutbutton"]))
{
    unset($_SESSION["login"]);
    session_destroy();
}
