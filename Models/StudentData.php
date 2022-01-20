<?php

class StudentData extends UserData
{

    protected $_studentID, $_cv, $_userID, $_name, $_email, $_phoneNumber, $_postalAddress, $_password;

    public function __construct($dbRow)
    {
        $this->_userID = $dbRow['user_id'];
        $this->_name = $dbRow['name'];
        $this->_email = $dbRow['email'];
        $this->_phoneNumber = $dbRow['phone_number'];
        $this->_postalAddress = $dbRow['postal_address'];
        $this->_password = $dbRow['password'];
        $this->_studentID = $dbRow['id_student'];
        $this->_cv = $dbRow['cv'];
    }

    public function getUserID()
    {
        return $this->_userID;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->_phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getPostalAddress()
    {
        return $this->_postalAddress;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
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


