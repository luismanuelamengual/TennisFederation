<?php

namespace org\fmt\model;

use NeoPHP\mvc\Model;

/**
 * @table (name="country")
 */
class Country extends Model 
{
    /**
     * @column (name="countryid", type="integer", id=true)
     */
    private $id;
    
    /**
     * @column (type="string")
     */
    private $description;
    
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
}

?>