<?php

$view = new stdClass();
$view->pageTitle = 'Register';

// Registering a new user to the database.
if (isset($_POST["registerbutton"])) {

    require_once('Models/UserDataSet.php');

    $userDataSet = new UserDataSet();

    if (true) {
        // Converting the inputs to lower case and hashing the password to ensure it is secure for storage in the database.
        $userDataSet->insertNewUser(strtolower($_POST["employerContactName"]), strtolower($_POST["employerEmail"]), strtolower($_POST["employerPhoneNumber"]), strtolower($_POST["employerPostalAddress"]), $_POST["employerPassword"]);
        $userID = $userDataSet->fetchUserID(strtolower($_POST["employerEmail"]));
        $userDataSet->insertNewEmployer($userID, "testPath", strtolower($_POST["employerCompanyName"]));
    } else {
        $_SESSION["registerError"] = "userID is already taken.";
    }
}

require_once('controller.php');
require_once('Views/registeremployer.phtml');