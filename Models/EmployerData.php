<?php

class EmployerData {
    
    protected $_employerID, $_contactName, $_email, $_phoneNumber, $_postalAddress, $_image, $_password, $_companyName ;
    
    public function __construct($dbRow) {
        $this->_employerID = $dbRow['id_employer'];
        $this->_contactName = $dbRow['contact_name'];
        $this->_email = $dbRow['email'];
        $this->_phoneNumber = $dbRow['phone_number'];
        $this->_postalAddress = $dbRow['postal_address'];
        $this->_image = $dbRow['image'];
        $this->_password = $dbRow['password'];
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
    public function getContactName()
    {
        return $this->_contactName;
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
    public function getImage()
    {
        return $this->_image;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->_companyName;
    }





}


