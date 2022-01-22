<?php

require_once ('Models/Database.php');
require_once ('Models/PlacementData.php');
require_once ('Models/RelationshipData.php');

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

    //generic no filter that returns any placements that have not been interacted with by the student logged in
    public function noFilter($uid) {
        $sqlQuery = "SELECT * FROM Placement WHERE Placement.id_placement NOT IN(SELECT placement_id FROM Relationship WHERE user_id = ?) LIMIT 1";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement

        $statement->bindParam(1,$uid);

        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new PlacementData($row);
        }
        return $dataSet;
    }

    //get the $eid from the session user_id to view all placements made by the employer logged in
    public function employerViewAllPlacements($eid){
        $sqlQuery = "SELECT * FROM Placement WHERE employer_id=?";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement

        $statement->bindParam(1,$eid);

        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new PlacementData($row);
        }
        return $dataSet;
    }

    public function fetchSpecificPlacement($pid) {
        $sqlQuery = "SELECT * FROM Placement WHERE id_placement=?";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement

        $statement->bindParam(1,$pid);

        $statement->execute(); // execute the PDO statement

        $row = $statement->fetch();
        //returns the placement specific to the ID

        return new placementData($row);
    }

    public function deletePlacement($pid) {
        $sqlQuery = "DELETE FROM Relationship WHERE placement_id=?;
                     DELETE FROM Placement WHERE id_placement=?";

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement

        $statement->bindParam(1,$pid);

        return $statement->execute(); //execute PDO Statement


    }

    public function editPlacement($pid, $_description, $_skillsRequired, $_salary, $_location, $_start, $_end, $_type) {
        $sqlQuery = "UPDATE Placement SET description=?, skills_required=?, salary=?, location=?, start=?, end=?, type=? WHERE id_placement=$pid";

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement

        $statement->bindParam(1, $_description);
        $statement->bindParam(2, $_skillsRequired);
        $statement->bindParam(3, $_salary);
        $statement->bindParam(4, $_location);
        $statement->bindParam(5, $_start);
        $statement->bindParam(6, $_end);
        $statement->bindParam(7, $_type);

        return $statement->execute(); //execute PDO
    }

    //still applies the no filter function but with an additional filter by placement type
    public function filterByType($type,$uid) {
        $sqlQuery = "SELECT * FROM Placement WHERE type = ? AND Placement.id_placement NOT IN(SELECT placement_id FROM Relationship WHERE user_id = ?) LIMIT 1";

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement

        $statement->bindParam(1,$type);
        $statement->bindParam(2,$uid);

        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new PlacementData($row);
        }
        return $dataSet;
    }

    public function deleteRelationships($pID) {
        $sqlQuery = "DELETE FROM Relationship WHERE placement_id=?";

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement

        $statement->bindParam(1,$pID);

        return $statement->execute(); //execute PDO Statement

    }
}


