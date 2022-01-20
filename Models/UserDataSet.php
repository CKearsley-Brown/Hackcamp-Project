<?php

require_once ('Models/Database.php');
require_once ('Models/UserData.php');
require_once ('Models/StudentData.php');
require_once ('Models/EmployerData.php');
require_once ('Models/RelationshipData.php');

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
        $sqlQuery = "SELECT * FROM Users WHERE email=?"; //prepare SQL to query the database

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement
        $statement->bindParam(1,$_email);
        $statement->execute(); // execute the PDO statement

        $row = $statement->fetch();

        if ($row != false) {
            $dataSet = new UserData($row);

            if (password_verify($_password, $dataSet->getPassword())) //checks passwords match
            {
                return true;
            } else return false;
        }
        else return false;
    }

    public function checkUniqueCName($CName)
    {
        //checks company name is unique when registering for an account
        $sqlPKeyCheck = "SELECT * From Employer WHERE company_name = ?"; // checks that the primary key is unique
        $checkStatement = $this->_dbHandle->prepare($sqlPKeyCheck); // prepare a PDO statement

        $checkStatement->bindParam(1,$CName);

        $checkStatement->execute(); // execute the PDO statement

        $row = $checkStatement->fetch();

        if ($row == false) {
            return true;
        }
        else return false;

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

    public function checkUniqueEmail($email) {
        $fetchUser = "SELECT * From Users WHERE email = ?"; // fetches a user with a given email
        $checkStatement = $this->_dbHandle->prepare($fetchUser); // prepare a PDO statement

        $checkStatement->bindParam(1,$email);

        $checkStatement->execute(); // execute the PDO statement


        if ($checkStatement->fetch() == false) {
            return true;
        }
        else return false;
    }

    public function fetchUserID($email) {
        $fetchUser = "SELECT * From Users WHERE email = ?"; // fetches a user with a given email
        $checkStatement = $this->_dbHandle->prepare($fetchUser); // prepare a PDO statement

        $checkStatement->bindParam(1,$email);

        $checkStatement->execute(); // execute the PDO statement

        $row = $checkStatement->fetch();
        $user = new UserData($row);         //returns the user ID

        return $user->getUserID();
    }

    //takes the user_id as input and returns the cv for that user, only if they are a student
    public function fetchCV($uid) {
        $sqlQuery = "SELECT * From Student WHERE id_student = ?"; // fetches a user with a given email
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement

        $statement->bindParam(1,$uid);

        $statement->execute(); // execute the PDO statement

        $row = $statement->fetch();
        $student = new StudentData($row);         //returns the cv

        return $student->getCV();
    }

    //takes the session user_id as input and the placement_id they are viewing and accepts the placement by inserting status 1 into the Relationship table
    public function studentAcceptPlacement($requestingID, $requestedID) {
        $sqlQuery = "INSERT INTO Relationship (user_id, placement_id, status) VALUES ($requestingID,$requestedID,'1')"; //prepare SQL to query the database
        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement
        return $statement->execute(); //execute PDO Statement
    }

    //takes the session user_id as input and the placement_id they are viewing and rejects the placement by inserting status 3 into the Relationship table
    public function studentRejectPlacement($requestingID, $requestedID) {
        $sqlQuery = "INSERT INTO Relationship (user_id, placement_id, status) VALUES ($requestingID,$requestedID,'3')"; //prepare SQL to query the database
        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement
        return $statement->execute(); //execute PDO Statement
    }

    //updates the pre-existing relationship by the employer accepting the student and updating the status to 2 in the Relationship table
    public function employerAcceptPlacement($uid,$pid) {
        $sqlQuery = "UPDATE Relationship SET status='2' WHERE user_id= ? AND placement_id= ?"; //prepare SQL to query the database

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement

        $statement->bindParam(1,$uid);
        $statement->bindParam(2,$pid);

        return $statement->execute(); //execute PDO Statement
    }

    //updates the pre-existing relationship by the employer rejecting the student and updating the status to 4 in the Relationship table
    public function employerRejectPlacement($uid,$pid) {
        $sqlQuery = "UPDATE Relationship SET status='4' WHERE user_id= ? AND placement_id= ?"; //prepare SQL to query the database

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement

        $statement->bindParam(1,$uid);
        $statement->bindParam(2,$pid);

        return $statement->execute(); //execute PDO Statement
    }

    //takes the session user_id and checks if the user id exists in the Employer table
    public function checkIfEmployer($userID) {
        $sqlQuery = "SELECT * FROM Employer WHERE id_employer= ?";
        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement

        $statement->bindParam(1, $userID);
        $statement->execute();

        $row = $statement->fetch();

        if ($row == false) {
            return false;
        }
        else return true;
    }

    //takes the session user_id and checks if the user id exists in the Student table
    public function checkIfStudent($userID) {
        $sqlQuery = "SELECT * FROM Student WHERE id_student= ?";
        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement

        $statement->bindParam(1, $userID);
        $statement->execute();

        $row = $statement->fetch();

        if ($row == false) {
            return false;
        }
        else return true;
    }

    public function studentAcceptedPlacements($pid) {
        $sqlQuery = "SELECT user_id FROM Relationship WHERE status=1 AND placement_id=$pid"; //prepare SQL to query the database

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = []; //create dataset to store query data
        while ($row = $statement->fetch()) {
            $dataSet[] = new UserData($row);
        }
        return $dataSet;
    }

    public function deleteStudent($uid) {
        $sqlQuery = "DELETE FROM Relationship WHERE user_id=?;
                     DELETE FROM Student WHERE id_student=?;
                     DELETE FROM Users WHERE user_id=?";

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare PDO Statement

        $statement->bindParam(1,$uid);

        return $statement->execute(); //execute PDO Statement
    }

    public function studentReturnProfile($uid) {
        $sqlQuery = "SELECT Users.name,Users.phone_number,Users.postal_address,Users.password,Student.cv 
                     FROM Users
                     INNER JOIN Student ON Users.user_id=Student.id_student
                     WHERE Users.user_id=?"; //prepare SQL to query the database
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement

        $statement->bindParam(1, $uid);
        $statement->execute();

        $dataSet = []; //create dataset to store query data
        while ($row = $statement->fetch()) {
            $dataSet[] = new StudentData($row);
        }
        return $dataSet;
    }


    public function StudentEditProfile($uid, $_name, $_phone_number, $_postal_address, $_cv) {
        $sqlQuery = "UPDATE Users SET name=?, phone_number=?, postal_address=?, WHERE user_id=$uid;
                     UPDATE Student SET cv=? WHERE user_id=$uid";

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement

        $statement->bindParam(1, $_name);
        $statement->bindParam(2, $_phone_number);
        $statement->bindParam(3, $_postal_address);
        $statement->bindParam(4, $_cv);

        return $statement->execute(); //execute PDO

    }


    public function EmployerReturnProfile($uid) {
        $sqlQuery = "SELECT Users.name,Users.phone_number,Users.postal_address,Users.password,Employer.image,Employer.company_name 
                     FROM Users 
                     INNER JOIN Employer ON Users.user_id=Employer.id_Employer 
                     WHERE Users.user_id=?"; //prepare SQL to query the database
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement

        $statement->bindParam(1, $uid);
        $statement->execute();

        $dataSet = []; //create dataset to store query data
        while ($row = $statement->fetch()) {
            $dataSet[] = new EmployerData($row);
        }
        return $dataSet;
    }


}