<?php
require_once('controller.php');

$view = new stdClass();
$view->pageTitle = 'Create Placement';

unset($_SESSION["placementError"]);

if ($_SESSION['user']->getLogStatus()) {
    if (isset($_POST["editPlacementButton"])) {
        require_once('Models/PlacementDataSet.php');

        $placementDataSet = new PlacementDataSet();

        $placementDataSet->editPlacement($_POST["placementDescripton"], $_POST["placementSkillsRequired"], $_POST["placementSalary"], $_POST["placementLocation"], $_POST["placementStart"], $_POST["placementEnd"], $_SESSION['user_id'], $_POST["placementType"]);
    }
}
else
{
    $_SESSION["placementError"] = "Not logged in";
}

require_once('Views/editplacement.phtml');