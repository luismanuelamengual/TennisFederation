<?php

namespace TennisFederation\models;

use NeoPHP\mvc\Model;

/**
 * @Table (tableName="usertype")
 */
class UserType extends Model 
{
    const USERTYPE_ADMINISTRATOR = 1;
    const USERTYPE_ORGANIZER = 2;
    const USERTYPE_PLAYER = 3;
    
    /**
     * @Column (columnName="usertypeid", id=true)
     */
    private $id;
    
    /**
     * @Column (columnName="description")
     */
    private $description;
    
    public function __construct($id=null)
    {
        $this->id = $id; 
    }
    
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