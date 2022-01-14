<?php

require_once ('Models/UserDataSet.php');


class User {

    protected $name, $logged_in_status, $userID ;

    //creates a user tracking object that can be used to store user data in $_SESSION
    public function __construct() {

        session_start();
        $this->name = "No User";
        $this->userID = "0";
        $this->logged_in_status = false;

        if (isset($_SESSION["login"])) //Sets $_SESSION values if a user is logged in
            {
                $this->name = $_SESSION["login"];
                $this->logged_in_status = true;
                $this->userID = $_SESSION["user_id"];
            }
    }

    public function getID() {
        return $this->userID; // Getter Method
    }

    public function getLogStatus() {
        return $this->logged_in_status; // Getter Method
    }

    public function getName() {
        return $this->name; // Getter Method
    }

    public function AuthenticateUser($_name, $_password) {
        $users = new UserDataSet();
        $usersDataSet = $users->checkUserCredentials($_name, $_password); // Creates a new dataset and calls the check credentials method
        //check credentials then takes the users username and password and checks if they exist in the database
        if (count($usersDataSet) > 0){
            $_SESSION["login"] = $_name; //sets the $_SESSION constant of "login" to the username
            $_SESSION["user_id"] = $usersDataSet[0]->getUserID(); //sets the $_SESSION constant of "user_id" to the users ID
            $this->logged_in_status = true;
            $this->name = $_name;
            $this->userID = $usersDataSet[0]->getUserID();
            return true;
        }
        else
        {
            $this->logged_in_status = false;
            return false;
        }
    }
            
}


