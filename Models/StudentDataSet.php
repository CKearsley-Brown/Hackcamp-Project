<?php

require_once ('Models/Database.php');
require_once ('Models/StudentData.php');

class StudentDataSet
{

    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllStudents() {
        $sqlQuery = 'SELECT * FROM Student'; //prepare SQL to query the database

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = []; //create dataset to store query data
        while ($row = $statement->fetch()) {
            $dataSet[] = new StudentData($row);
        }
        return $dataSet;
    }

    public function registerStudent($_name,$_email,$_phone,$_cv,$_password) {
        $sqlQuery = "INSERT INTO Student (name, email, phone, cv, password) VALUES (?,?,?,?,?)"; //prepare SQL to query the database
        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement

        //$encpassword = password_hash($_password, PASSWORD_DEFAULT);

        $statement->bindparam(1, $_name); //binds parameter values to variables within the function
        $statement->bindparam(2, $_email); //doing this helps remove sql injection
        $statement->bindparam(3, $_phone);
        $statement->bindparam(4, $_cv);
        $statement->bindparam(5, $_password);
        return $statement->execute(); // execute the PDO statement
    }
}


