<?php

class UserData {
    
    protected $_userID, $_firstName, $_lastName, $_username, $_email, $_password, $_photo ;
    
    public function __construct($dbRow) {
        $this->_userID = $dbRow['id'];
        $this->_username = $dbRow['username'];
        $this->_email = $dbRow['email'];
        $this->_password = $dbRow['password'];
        $this->_firstName = $dbRow['first_name'];
        $this->_lastName = $dbRow['last_name'];
        $this->_photo = $dbRow['photo'];
        //add lat and long here in trimester 2
    }
    public function getUserID() {
        return $this->_userID; //getter method
    }

    public function getFirstName() {
       return $this->_firstName; //getter method
    }
    
    public function getLastName() {
       return $this->_lastName; //getter method
    }

    public function getEmail() {
        return $this->_email; //getter method
    }

    public function getPassword() {
        return $this->_password; //getter method
    }

    public function getUsername() {
        return $this->_username; //getter method
    }
    public function getPhoto() {
        return $this->_photo; //getter method
    }






}


