<?php
require_once('controller.php');

$view = new stdClass();
$view->pageTitle = 'Index';

// if logged in
if (isset($_SESSION["login"])) {
    // If logged in as student, get next placement if any
    if ($userTableDataSet->checkIfStudent($_SESSION['user_id'])) {
        require_once('Models/PlacementDataSet.php');
        $placementDataSet = new PlacementDataSet();
        if (!isset($_SESSION["filter"])) {
            $view->placementDataSet = $placementDataSet->noFilter($_SESSION['user_id']);
        } else {
            $view->placementDataSet = $placementDataSet->filterByType($_SESSION["filter"], $_SESSION['user_id']);
        }
    }

    // Filter button is pressed
    if (isset($_POST["filterButton"])) {
        if ($_POST["filterType"] == "noFilter") {
            unset($_SESSION["filter"]);
        } else {
            $_SESSION["filter"] = $_POST["filterType"];
        }
        header("Refresh:0");
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

    if ($userTableDataSet->checkIfEmployer($_SESSION['user_id'])) {
        require_once('Models/PlacementDataSet.php');
        $placementDataSet = new PlacementDataSet();
        $view->placementDataSet = $placementDataSet->employerViewAllPlacements($_SESSION['user_id']);
    }

    if (isset($_POST["employerMatchingYes"])) {
        $studentID = substr($_POST["employerMatchingYes"],7);
        $userTableDataSet->employerAcceptPlacement($studentID, $_POST["hiddenPlacementID"]);
    }

    if (isset($_POST["employerMatchingNo"])) {
        $recipient = substr($_POST["employerMatchingNo"],7);
        $userTableDataSet->employerRejectPlacement($studentID, $_POST["hiddenPlacementID"]);
    }
}

require_once('Views/index.phtml');