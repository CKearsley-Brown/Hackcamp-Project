<?php

class RelationshipData extends StudentData{
    
    protected $_relationshipID, $_userID, $_placementID, $_status, $_studentID, $_cv ;
    
    public function __construct($dbRow) {
        $this->_relationshipID = $dbRow['relationship_id'];
        $this->_userID = $dbRow['user_id'];
        $this->_placementID = $dbRow['placement_id'];
        $this->_status = $dbRow['status'];
        $this->_studentID = $dbRow['id_student'];
        $this->_cv = $dbRow['cv'];
    }

    /**
     * @return mixed
     */
    public function getStudentID()
    {
        return $this->_studentID;
    }

    /**
     * @return mixed
     */
    public function getCv()
    {
        return $this->_cv;
    }

    /**
     * @return mixed
     */
    public function getRelationshipID()
    {
        return $this->_relationshipID;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->_userID;
    }

    /**
     * @return mixed
     */
    public function getPlacementID()
    {
        return $this->_placementID;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->_status;
    }



            
}


