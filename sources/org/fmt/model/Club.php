<?php

namespace org\fmt\model;

use NeoPHP\mvc\Model;

/**
 * @table (name="club")
 */
class Club extends Model 
{
    /**
     * @column (name="clubid", id=true)
     */
    private $id;
    
    /**
     * @column (name="description")
     */
    private $description;
    
    /**
     * @column (name="latitude")
     */
    private $latitude;
    
    /**
     * @column (name="longitude")
     */
    private $longitude;
    
    /**
     * @column (name="address")
     */
    private $address;
    
    /**
     * @column (name="contactvia1")
     */
    private $contactvia1;
    
    /**
     * @column (name="contactvia2")
     */
    private $contactvia2;
    
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
}

?>