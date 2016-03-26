<?php

namespace org\fmt\model;

use NeoPHP\mvc\Model;

class Category extends Model
{
    private $id;
    private $description;
    private $matchType;
    
    public function __construct ($id=null)
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

    public function getMatchType() 
    {
        return $this->matchType;
    }

    public function setMatchType($matchType) 
    {
        $this->matchType = $matchType;
    }
}