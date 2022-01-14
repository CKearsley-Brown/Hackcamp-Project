<?php

require_once ('Models/UserDataSet.php');


class User {

    protected $email, $logged_in_status, $userID ;

    //creates a user tracking object that can be used to store user data in $_SESSION
    public function __construct() {

        session_start();
        $this->email = "No Email";
        $this->userID = "0";
        $this->logged_in_status = false;

        if (isset($_SESSION["login"])) //Sets $_SESSION values if a user is logged in
            {
                $this->email = $_SESSION["login"];
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
        return $this->email; // Getter Method
    }

    public function AuthenticateUser($_email, $_password) {
        $users = new UserDataSet();
        $check = $users->checkUserCredentials($_email, $_password); // Creates a new dataset and calls the check credentials method
        //check credentials then takes the users username and password and checks if they exist in the database
        if ($check == false){
            $_SESSION["login"] = $_email; //sets the $_SESSION constant of "login" to the username
            $_SESSION["user_id"] = $usersDataSet[0]->getUserID(); //sets the $_SESSION constant of "user_id" to the users ID
            $this->logged_in_status = true;
            $this->email = $_email;
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


