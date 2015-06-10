<?php

namespace org\fmt\model;

/**
 * @table (tableName="country")
 */
class Country extends Entity 
{
    /**
     * @column (columnName="countryid", id=true)
     */
    private $id;
    
    /**
     * @column (columnName="description")
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