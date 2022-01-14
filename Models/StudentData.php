<?php

class StudentData
{

    protected $_studentID, $_cv;

    public function __construct($dbRow)
    {
        $this->_studentID = $dbRow['id_student'];
        $this->_cv = $dbRow['cv'];
    }

    public function getStudentID()
    {
        return $this->_studentID; //getter method
    }

    public function getCV()
    {
        return $this->_cv; //getter method
    }




}


