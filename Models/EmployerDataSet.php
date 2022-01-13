<?php

require_once ('Database.php');
require_once ('EmployerData.php');
class EmployerDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function insertNewEmployer($contactName, $email, $phoneNumber, $postalAddress, $image, $password, $companyName) {

        $sqlQuery = "INSERT INTO Employer (contact_name, email, phone_number, postal_address, image, password, company_name) values (?,?,?,?,?,?,?);";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepares PDO statement

        $hashPWD = password_hash($password, PASSWORD_DEFAULT);


        $statement->bindParam(1,$contactName);
        $statement->bindParam(2,$email);
        $statement->bindParam(3, $phoneNumber);
        $statement->bindParam(4, $postalAddress);
        $statement->bindParam(5,$image);
        $statement->bindParam(6,$hashPWD);
        $statement->bindParam(7,$companyName);


        $statement->execute(); // execute the PDO statement
    }
}