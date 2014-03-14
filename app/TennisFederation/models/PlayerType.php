<?php

namespace TennisFederation\models;

use NeoPHP\mvc\Model;

/**
 * @Table (tableName="playertype")
 */
class PlayerType extends Model 
{
    /**
     * @Column (columnName="playertypeid", id=true)
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