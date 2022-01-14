<?php

class EmployerData {
    
    protected $_employerID, $_image, $_companyName ;
    
    public function __construct($dbRow) {
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


