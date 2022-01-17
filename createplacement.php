<?php

$view = new stdClass();
$view->pageTitle = 'Create Placement';

if (isset($_POST["placementButton"])) {

    require_once('Models/PlacementDataSet.php');

    $placementDataSet = new PlacementDataSet();
    // replace set employer to require session log in and grab the session login id
    var_dump($placementDataSet->createNewPlacement($_POST["placementDescripton"], $_POST["placementSkillsRequired"], $_POST["placementSalary"], $_POST["placementLocation"], $_POST["placementStart"], $_POST["placementEnd"], "6", $_POST["placementType"]));

}

require_once('controller.php');
require_once('Views/createplacement.phtml');