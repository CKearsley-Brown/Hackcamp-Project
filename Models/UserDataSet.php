<?php

require_once ('Models/Database.php');
require_once ('Models/UserData.php');
require_once ('Models/StudentData.php');
require_once ('Models/EmployerData.php');

class UserDataSet
{

    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllUsers() {
        $sqlQuery = 'SELECT * FROM Users'; //prepare SQL to query the database

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = []; //create dataset to store query data
        while ($row = $statement->fetch()) {
            $dataSet[] = new UserData($row);
        }
        return $dataSet;
    }

    public function insertNewUser($_name,$_email,$_phone,$_postalAddress,$_password) {
        $sqlQuery = "INSERT INTO Users (name, email, phone_number, postal_address, password) VALUES (?,?,?,?,?)"; //prepare SQL to query the database
        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement

        $encpassword = password_hash($_password, PASSWORD_DEFAULT);

        $statement->bindparam(1, $_name); //binds parameter values to variables within the function
        $statement->bindparam(2, $_email); //doing this helps remove sql injection
        $statement->bindparam(3, $_phone);
        $statement->bindparam(4, $_postalAddress);
        $statement->bindparam(5, $encpassword);
        return $statement->execute(); // execute the PDO statement
    }

    public function checkUserCredentials($_email, $_password) {
        $sqlQuery = "SELECT * FROM users WHERE email=? AND password=?"; //prepare SQL to query the database

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement

        $statement->bindParam(1,$_email);
        $statement->bindParam(2,$_password);
        $statement->execute(); // execute the PDO statement

        $dataSet = []; //create dataset to store query data
        while ($row = $statement->fetch()) {
            $dataSet[] = new UserData($row);
        }
        return $dataSet;
    }

    public function checkUniqueCName($CName)
    {
        //checks company name is unique when registering for an account
        $sqlPKeyCheck = "SELECT * From Employer WHERE company_name = ?"; // checks that the primary key is unique
        $checkStatement = $this->_dbHandle->prepare($sqlPKeyCheck); // prepare a PDO statement

        $checkStatement->bindParam(1,$CName);

        $checkStatement->execute(); // execute the PDO statement

        $row = $checkStatement->fetch();

        $pass = false;
        $data = new EmployerData($row);
        if($data->getCompanyName() == null)
        {
            $pass = true;
        }

        return $pass;

    }

    public function insertNewEmployer($_ID, $_imagePath,$_companyName) {
        $sqlQuery = "INSERT INTO Employer (id_employer, image, company_name) VALUES (?,?,?)"; //prepare SQL to query the database
        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement


        $statement->bindparam(1, $_ID); //binds parameter values to variables within the function
        $statement->bindparam(2, $_imagePath); //doing this helps remove sql injection
        $statement->bindparam(3, $_companyName);

        return $statement->execute(); // execute the PDO statement
    }

    public function insertNewStudent($_ID, $_cv) {
        $sqlQuery = "INSERT INTO Student (id_student, cv) VALUES (?,?)"; //prepare SQL to query the database
        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement


        $statement->bindparam(1, $_ID); //binds parameter values to variables within the function
        $statement->bindparam(2, $_cv); //doing this helps remove sql injection


        return $statement->execute(); // execute the PDO statement
    }
}


