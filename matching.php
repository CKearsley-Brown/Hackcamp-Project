<?php
require_once('controller.php');

$view = new stdClass();
$view->pageTitle = 'Matching';

require_once('Views/matching.phtml');