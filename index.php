<?php
require_once('controller.php');

$view = new stdClass();
$view->pageTitle = 'Index';

unset($_SESSION["loginError"]);

// Collect username and password for checking with password_verify
if (isset($_POST["loginbutton"]))
{
    if (!$_SESSION['user']->AttemptLoginUser($_POST["email"],$_POST["password"]))
    {
        $_SESSION["loginError"] = "Incorrect Email or Password.";
    }
}

// if logged in
if (isset($_SESSION["login"])) {
    // If logged in as student, get next placement if any
    if ($userTableDataSet->checkIfStudent($_SESSION['user_id'])) {
        require_once('Models/PlacementDataSet.php');
        $placementDataSet = new PlacementDataSet();
        $view->placementDataSet = $placementDataSet->noFilter($_SESSION['user_id']);
    }

    // Student Accepts Placement
    if (isset($_POST["studentMatchingYes"])) {
        $userTableDataSet->studentAcceptPlacement($_SESSION['user_id'], $view->placementDataSet[0]->getPlacementID());
        header("Refresh:0");
    }

    // Student Rejects Placement
    if (isset($_POST["studentMatchingNo"])) {
        $userTableDataSet->studentRejectPlacement($_SESSION['user_id'], $view->placementDataSet[0]->getPlacementID());
        header("Refresh:0");
    }

    // REPLACE RELATIONSHIP_ID !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    if (isset($_POST["employerMatchingYes"])) {
        $userTableDataSet->employerAcceptPlacement($relationship_id);
    }

    // REPLACE RELATIONSHIP_ID !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    if (isset($_POST["employerMatchingNo"])) {
        $userTableDataSet->employerRejectPlacement($relationship_id);
    }
}

require_once('Views/index.phtml');