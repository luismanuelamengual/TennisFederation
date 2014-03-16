<?php

namespace TennisFederation\models;

use NeoPHP\mvc\Model;

/**
 * @Table (tableName="category")
 */
class Category extends Model
{
    /**
     * @Column (columnName="categoryid", id=true)
     */
    private $id;
    
    /**
     * @Column (columnName="description")
     */
    private $description;
    
    /**
     * @Column (columnName="matchtype")
     */
    private $matchType;
    
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

    public function getMatchType() 
    {
        return $this->matchType;
    }

    public function setMatchType($matchType) 
    {
        $this->matchType = $matchType;
    }
}

?>