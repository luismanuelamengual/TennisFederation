<?php

namespace org\fmt\model;

use NeoPHP\mvc\Model;

/**
 * @table (name="province")
 */
class Province extends Model 
{
    /**
     * @column (name="provinceid", type="integer", id=true)
     */
    private $id;
    
    /**
     * @column (type="string")
     */
    private $description;
    
    /**
     * @column (name="countryid", entityClassName="Country")
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