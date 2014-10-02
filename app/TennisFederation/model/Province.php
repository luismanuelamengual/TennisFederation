<?php

namespace TennisFederation\model;

use NeoPHP\mvc\DatabaseModel;

/**
 * @Table (tableName="province")
 */
class Province extends DatabaseModel 
{
    /**
     * @Column (columnName="provinceid", id=true)
     */
    private $id;
    
    /**
     * @Column (columnName="description")
     */
    private $description;
    
    /**
     * @Column (columnName="countryid", relatedTableName="country")
     */
    private $country;
    
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
    
    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry(Country $country)
    {
        $this->country = $country;
    }
}

?>