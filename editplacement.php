<?php
require_once('controller.php');

$view = new stdClass();
$view->pageTitle = 'Create Placement';

unset($_SESSION["placementError"]);

if ($_SESSION['user']->getLogStatus()) {
    if ($userTableDataSet->checkIfEmployer($_SESSION['user_id'])) {
        require_once('Models/PlacementDataSet.php');
        $emptyPlacementDataSet = new PlacementDataSet();
        $view->emptyPlacementDataSet = $emptyPlacementDataSet;
        $view->placementDataSet = $emptyPlacementDataSet->employerViewAllPlacements($_SESSION['user_id']);
    }

    if (isset($_POST['placementSelectButton']))
    {
        if ($_POST["placementSelected"] == "noPlacement") {
            unset($_SESSION["placementSelect"]);
        } else {
            $_SESSION["placementSelect"] = $_POST["placementSelected"];
        }
        header("Refresh:0");
    }

    if (isset($_POST["editPlacementButton"])) {
        require_once('Models/PlacementDataSet.php');

        $placementDataSet = new PlacementDataSet();
        $placementDataSet->editPlacement($_SESSION['placementSelect'],$_POST["placementDescripton"], $_POST["placementSkillsRequired"], $_POST["placementSalary"], $_POST["placementLocation"], $_POST["placementStart"], $_POST["placementEnd"], $_POST["placementType"]);
    }
}
else
{
    $_SESSION["placementError"] = "Not logged in";
}

require_once('Views/editplacement.phtml');