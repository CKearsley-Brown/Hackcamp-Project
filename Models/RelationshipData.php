<?php

class RelationshipData {
    
    protected $_studentID, $_placementID, $_status;
    
    public function __construct($dbRow) {
        $this->_studentID = $dbRow['student_id'];
        $this->_placementID = $dbRow['student_id'];
        $this->_status = $dbRow['status'];
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


