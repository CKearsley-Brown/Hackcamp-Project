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

// REPLACE PLACEMENT_ID !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if (isset($_POST["studentMatchingYes"]))
{
    require_once('Models/PlacementDataSet.php');
    $placementDataSet = new PlacementDataSet();
    $placementDataSet->studentAcceptPlacement($_SESSION['user_id'], $placement_id);
}

// REPLACE PLACEMENT_ID !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if (isset($_POST["studentMatchingNo"]))
{
    require_once('Models/PlacementDataSet.php');
    $placementDataSet = new PlacementDataSet();
    $placementDataSet->studentRejectPlacement($_SESSION['user_id'], $placement_id);
}

// REPLACE RELATIONSHIP_ID !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if (isset($_POST["employerMatchingYes"]))
{
    require_once('Models/PlacementDataSet.php');
    $placementDataSet = new PlacementDataSet();
    $placementDataSet->employerAcceptPlacement($relationship_id);
}

// REPLACE RELATIONSHIP_ID !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if (isset($_POST["employerMatchingNo"]))
{
    require_once('Models/PlacementDataSet.php');
    $placementDataSet = new PlacementDataSet();
    $placementDataSet->employerRejectPlacement($relationship_id);
}

require_once('Views/index.phtml');