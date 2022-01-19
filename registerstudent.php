<?php
require_once('controller.php');

$view = new stdClass();
$view->pageTitle = 'Register Student';

unset($_SESSION["registerError"]);

// Registering a new user to the database.
if (isset($_POST["registerbutton"])) {

    require_once('Models/UserDataSet.php');

    $userDataSet = new UserDataSet();

    if ($userDataSet->checkUniqueEmail($_POST["studentEmail"])) {
        $userDataSet->insertNewUser(strtolower($_POST["studentName"]), strtolower($_POST["studentEmail"]), strtolower($_POST["studentPhoneNumber"]), strtolower($_POST["studentPostalAddress"]), $_POST["studentPassword"]);
        $userID = $userDataSet->fetchUserID(strtolower($_POST["studentEmail"]));
        //uploads the image
        $target_dir = "CVs/";
        if ($_FILES['file']['name'] == null) {
            $upload = 1;
            $target_file = null;
        }
        else {
            $target_file = $target_dir . $_SESSION('user_id'). "_cv";
            $upload = 0; // whether the file will be uploaded, no by default
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is an actual image or fake image

            $cvCheck = filesize($_FILES["file"]["tmp_name"]);
            if ($cvCheck !== false) {
                $upload = 1; // sets upload to yes
            }
            else {
                $_SESSION["registerError"] = "File is not an CV.";
                $upload = 0;
            }
        }
        if ($upload == 1 && $target_file != null && move_uploaded_file($_FILES["file"]["tmp_name"], $target_file) != null) {

            //if image upload was successful a new account is made with the uploaded image
            //insertNewStudent($_ID, $_cv)
            $userDataSet->insertNewStudent($userID, $target_file);
        }
        else {
            $userDataSet->insertNewStudent($userID, "testPath");
        }
    }
    else {
        $_SESSION["registerError"] = "Email is already taken.";
    }
}

require_once('Views/registerstudent.phtml');