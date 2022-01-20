<?php
require_once('controller.php');

$view = new stdClass();
$view->pageTitle = 'Register Employer';

unset($_SESSION["registerError"]);

// Registering a new user to the database.
if (isset($_POST["registerbutton"])) {

    require_once('Models/UserDataSet.php');

    $userDataSet = new UserDataSet();

    if ($userDataSet->checkUniqueEmail($_POST["employerEmail"]) && $userDataSet->checkUniqueCName($_POST["employerCompanyName"])) {
        $userDataSet->insertNewUser(strtolower($_POST["employerContactName"]), strtolower($_POST["employerEmail"]), strtolower($_POST["employerPhoneNumber"]), strtolower($_POST["employerPostalAddress"]), $_POST["employerPassword"]);
        $userID = $userDataSet->fetchUserID(strtolower($_POST["employerEmail"]));
        //uploads the image
        $target_dir = "images/";
        if ($_FILES['img']['name'] == null) {
            $upload = 1;
            $target_file = null;
        }
        else {
            $tempFileExt = explode('.', $_FILES["img"]["name"]);
            $fileExt = strtolower(end($tempFileExt));
            $target_file = $target_dir . $userID . "_img." . $fileExt;
            $upload = 0; // whether the file will be uploaded, no by default
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is an actual image or fake image

            $imgCheck = getimagesize($_FILES["img"]["tmp_name"]);
            if ($imgCheck !== false) {
                $upload = 1; // sets upload to yes
            }
            else {
                $_SESSION["registerError"] = "File is not an image.";
                $upload = 0;
            }
        }
        if ($upload == 1 && $target_file != null && move_uploaded_file($_FILES["img"]["tmp_name"], $target_file) != null) {

            //if image upload was successful a new account is made with the uploaded image
            $userDataSet->insertNewEmployer($userID, $target_file, strtolower($_POST["employerCompanyName"]));
        }
        else {
            $_SESSION["registerError"] = "Please input an image.";
        }
    }
    else {
        $_SESSION["registerError"] = "Email or company name is already taken.";
    }
}

require_once('Views/registeremployer.phtml');