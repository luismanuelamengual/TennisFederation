<?php

namespace TennisFederation\models;

use NeoPHP\mvc\DatabaseModel;

/**
 * @Table (tableName="club")
 */
class Club extends DatabaseModel 
{
    /**
     * @Column (columnName="clubid", id=true)
     */
    private $id;
    
    /**
     * @Column (columnName="description")
     */
    private $description;
    
    /**
     * @Column (columnName="latitude")
     */
    private $latitude;
    
    /**
     * @Column (columnName="longitude")
     */
    private $longitude;
    
    /**
     * @Column (columnName="address")
     */
    private $address;
    
    /**
     * @Column (columnName="contactvia1")
     */
    private $contactvia1;
    
    /**
     * @Column (columnName="contactvia2")
     */
    private $contactvia2;

    /**
     * @Column (columnName="provinceid", relatedTableName="province")
     */
    private $province;
    
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function setDescription($description) 
    {
        $this->description = $description;
    }
    
    public function getLatitude() 
    {
        return $this->latitude;
    }

    public function setLatitude($latitude) 
    {
        $this->latitude = $latitude;
    }

    public function getLongitude() 
    {
        return $this->longitude;
    }

    public function setLongitude($longitude) 
    {
        $this->longitude = $longitude;
    }
    
    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getContactvia1()
    {
        return $this->contactvia1;
    }

    public function setContactvia1($contactvia1)
    {
        $this->contactvia1 = $contactvia1;
    }

    public function getContactvia2()
    {
        return $this->contactvia2;
    }

    public function setContactvia2($contactvia2)
    {
        $this->contactvia2 = $contactvia2;
    }
    
    public function getProvince()
    {
        return $this->province;
    }

    public function setProvince(Province $province)
    {
        $this->province = $province;
    }
}

?>