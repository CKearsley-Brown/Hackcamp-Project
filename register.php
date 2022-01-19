<?php
require_once('controller.php');

$view = new stdClass();
$view->pageTitle = 'Register';

require_once('Views/register.phtml');