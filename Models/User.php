<?php

require_once ('Models/UserDataSet.php');


class User {

    protected $username, $logged_in_status, $userID ;

    //creates a user tracking object that can be used to store user data in $_SESSION
    public function __construct() {

        session_start();
        $this->username = "No User";
        $this->userID = "0";
        $this->logged_in_status = false;

        if (isset($_SESSION["login"])) //Sets $_SESSION values if a user is logged in
            {
                $this->username = $_SESSION["login"];
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

    public function getUname() {
        return $this->username; // Getter Method
    }

    public function AuthenticateUser($_username, $_password) {
        $users = new UserDataSet();
        $usersDataSet = $users->checkUserCredentials($_username, $_password); // Creates a new dataset and calls the check credentials method
        //check credentials then takes the users username and password and checks if they exist in the database
        if (count($usersDataSet) > 0){
            $_SESSION["login"] = $_username; //sets the $_SESSION constant of "login" to the username
            $_SESSION["user_id"] = $usersDataSet[0]->getUserID(); //sets the $_SESSION constant of "user_id" to the users ID
            $this->logged_in_status = true;
            $this->username = $_username;
            $this->userID = $usersDataSet[0]->getUserID();
            //echo "logged in";
            return true;
        }
        else
        {
            //echo "not logged in";
            $this->logged_in_status = false;
            return false;
        }
    }
            
}


