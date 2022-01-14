<?php

require_once ('Models/PlacementData.php');

class PlacementDataSet {

    protected $_dbInstance, $_dbHandle ;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }






}


