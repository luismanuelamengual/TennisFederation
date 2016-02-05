<?php

namespace org\fmt\model;

use NeoPHP\mvc\Model;

/**
 * @table (name="usertype")
 */
class UserType extends Model 
{   
    /**
     * @column (name="usertypeid", id=true)
     */
    private $id;
    
    /**
     * @column (name="description")
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