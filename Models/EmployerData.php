<?php

class EmployerData extends UserData {
    
    protected $_employerID, $_image, $_companyName, $_userID, $_name, $_email, $_phoneNumber, $_postalAddress, $_password ;
    
    public function __construct($dbRow) {
        $this->_userID = $dbRow['user_id'];
        $this->_name = $dbRow['name'];
        $this->_email = $dbRow['email'];
        $this->_phoneNumber = $dbRow['phone_number'];
        $this->_postalAddress = $dbRow['postal_address'];
        $this->_password = $dbRow['password'];
        $this->_employerID = $dbRow['id_employer'];
        $this->_image = $dbRow['image'];
        $this->_companyName = $dbRow['company_name'];
    }

    /**
     * @return mixed
     */
    public function getEmployerID()
    {
        return $this->_employerID;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->_image;
    }


    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->_companyName;
    }





}


