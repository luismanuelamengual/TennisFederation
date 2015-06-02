<?php

namespace org\fmt\model;

use NeoPHP\mvc\DatabaseModel;

/**
 * @Table (tableName="country")
 */
class Country extends DatabaseModel 
{
    /**
     * @Column (columnName="countryid", id=true)
     */
    private $id;
    
    /**
     * @Column (columnName="description")
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