<?php

require_once ('Models/PlacementData.php');

class PlacementDataSet {

    protected $_dbInstance, $_dbHandle ;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }


    public function noFilter() {
        $sqlQuery = "SELECT * FROM Placement WHERE id_placement NOT IN (SELECT placement_id FROM Relationship) LIMIT 1";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement

        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new UserData($row);
        }
        return $dataSet;
    }

    public function filterByType($type) {
        $sqlQuery = "SELECT * FROM Placement WHERE type = ? AND id_placement NOT IN (SELECT placement_id FROM Relationship) LIMIT 1";

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement

        $statement->bindParam(1,$type);

        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new UserData($row);
        }
        return $dataSet;


    }



}


