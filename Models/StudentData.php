<?php

class StudentData
{

    protected $_studentID, $_name, $_email, $_password, $_cv, $_phone;

    public function __construct($dbRow)
    {
        $this->_studentID = $dbRow['id_student'];
        $this->_name = $dbRow['name'];
        $this->_email = $dbRow['email'];
        $this->_password = $dbRow['password'];
        $this->_cv = $dbRow['cv'];
        $this->_phone = $dbRow['phone'];
        //add lat and long here in trimester 2
    }

    public function getStudentID()
    {
        return $this->_studentID; //getter method
    }

    public function getName()
    {
        return $this->_name; //getter method
    }

    public function getEmail()
    {
        return $this->_email; //getter method
    }

    public function getPassword()
    {
        return $this->_password; //getter method
    }


    public function getCV()
    {
        return $this->_cv; //getter method
    }

    public function getPhone()
    {
        return $this->_phone;
    }


}


