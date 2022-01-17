<?php

$view = new stdClass();
$view->pageTitle = 'Create Placement';

if (isset($_POST["registerbutton"])) {

    require_once('Models/PlacementDataSet.php');

    $placementDataSet = new PlacementDataSet();
    // $_description,$_skillsRequired,$_salary,$_location,$_start,$_end,$_employerID,$_type
    $placementDataSet->createNewPlacement(placementDescripton, placementSkillsRequired, placementSalary, placementLocation, placementStart, placementEnd, placementType);

}

require_once('controller.php');
require_once('Views/createplacement.phtml');