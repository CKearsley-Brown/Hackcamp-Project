<?php

class PlacementData {

    protected $_placementID, $_description, $_skillsRequired, $_salary, $_start, $_end, $_employerID, $_location ;

    public function __construct($dbRow) {
        $this->_placementID = $dbRow['id_placement'];
        $this->_description = $dbRow['description'];
        $this->_skillsRequired = $dbRow['skills_required'];
        $this->_salary = $dbRow['salary'];
        $this->_start = $dbRow['start'];
        $this->_end = $dbRow['end'];
        $this->_employerID = $dbRow['employer_id'];
        $this->_location = $dbRow['location'];
        //add lat and long here in trimester 2
    }
    public function getPlacementID() {
        return $this->_placementID; //getter method
    }

    public function getDescription() {
        return $this->_description; //getter method
    }

    public function getSkillsRequired() {
        return $this->_skillsRequired; //getter method
    }

    public function getSalary() {
        return $this->_salary; //getter method
    }

    public function getLocation() {
        return $this->_location; //getter method
    }

    public function getStart() {
        return $this->_start; //getter method
    }
    public function getEnd() {
        return $this->_end; //getter method
    }

    public function getEmployerID() {
        return $this->_employerID;
    }






}


