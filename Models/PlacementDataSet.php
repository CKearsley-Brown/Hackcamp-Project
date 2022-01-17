<?php

require_once ('Models/PlacementData.php');

class PlacementDataSet {

    protected $_dbInstance, $_dbHandle ;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function createNewPlacement($_description,$_skillsRequired,$_salary,$_location,$_start,$_end,$_employerID,$_type)
    {
        $sqlQuery = "INSERT INTO Placement (description, skills_required, salary, location, start, end, employer_id, type) VALUES(?,?,?,?,?,?,?,?)"; //prepare SQL to query the database
        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement

        $statement->bindParam(1, $_description);
        $statement->bindParam(2, $_skillsRequired);
        $statement->bindParam(3, $_salary);
        $statement->bindParam(4, $_location);
        $statement->bindParam(5, $_start);
        $statement->bindParam(6, $_end);
        $statement->bindParam(7, $_employerID);
        $statement->bindParam(8, $_type);
        return $statement->execute(); // execute the PDO statement
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


