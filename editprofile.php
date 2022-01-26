<?php
require_once('controller.php');

$view = new stdClass();
$view->pageTitle = 'Register Employer';

unset($_SESSION["registerError"]);

if ($userTableDataSet->checkIfEmployer($_SESSION['user_id'])) {
    if (isset($_POST["deleteEmployerButton"])) {
        $userTableDataSet->deleteEmployer($_SESSION['user_id']);
        unset($_SESSION["user_id"]);
        unset($_SESSION["login"]);
        session_destroy();
        $user = new User();
        $_SESSION['user'] = $user;
        header("Location: index.php");
    }

    if (isset($_POST["editEmployerButton"])) {
        require_once('Models/UserDataSet.php');

        $userID = $_SESSION['user_id'];
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
                $_SESSION["editProfileError"] = "File is not an image.";
                $upload = 0;
            }
        }
        if ($upload == 1 && $target_file != null && move_uploaded_file($_FILES["img"]["tmp_name"], $target_file) != null) {
            //if image upload was successful a new account is made with the uploaded image
            $userTableDataSet->employerEditProfile($_POST['employerContactName'], $_POST['employerPhoneNumber'], $_POST['employerPostalAddress'], $target_file, $userID);
        }
        else {
            $_SESSION["registerError"] = "Please input an image.";
        }
    }
}

if ($userTableDataSet->checkIfStudent($_SESSION['user_id'])) {
    if (isset($_POST["deleteStudentButton"])) {
        $userTableDataSet->deleteStudent($_SESSION['user_id']);
        unset($_SESSION["user_id"]);
        unset($_SESSION["login"]);
        session_destroy();
        $user = new User();
        $_SESSION['user'] = $user;
        header("Location: index.php");
    }

    if (isset($_POST["editStudentButton"])) {
        require_once('Models/UserDataSet.php');

        $userID = $_SESSION['user_id'];
        //uploads the image
        $target_dir = "CVs/";
        if ($_FILES['file']['name'] == null) {
            $upload = 1;
            $target_file = null;
        }
        else {
            $tempFileExt = explode('.', $_FILES["file"]["name"]);
            $fileExt = strtolower(end($tempFileExt));
            $target_file = $target_dir . $userID . "_cv." . $fileExt;
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
            $userTableDataSet->studentEditProfile($_POST['studentName'], $_POST['studentPhoneNumber'], $_POST['studentPostalAddress'], $target_file, $userID);
        }
        else {
            $_SESSION["registerError"] = "Please input a CV.";
        }

    }
}

require_once('Views/editprofile.phtml');