<?php
require_once('controller.php');

$view = new stdClass();
$view->pageTitle = 'View Accepted Placements';

if (isset($_SESSION["login"])) {
    // If logged in as student, get next placement if any
    if ($userTableDataSet->checkIfStudent($_SESSION['user_id'])) {

    }
}

require_once('Views/viewacceptedplacements.phtml');