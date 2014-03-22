<?php

namespace TennisFederation\components;

use NeoPHP\util\IntrospectionUtils;

class EntityCombobox extends Combobox
{
    private $valueFieldName;
    private $displayFieldName;   
    
    public function __construct($attributes=array(), $entities=array())
    {
        parent::__construct($attributes);
        $this->valueFieldName = "id";
        $this->displayFieldName = "description";
        $this->setEntities($entities);
    }
    
    public function setValueFieldName ($valueFieldName)
    {
        $this->valueFieldName = $valueFieldName;
    }
    
    public function setDisplayFieldName ($displayFieldName)
    {
        $this->displayFieldName = $displayFieldName;
    }
    
    public function setEntities ($entities = array())
    {
        foreach ($entities as $entity)
            $this->addEntity ($entity);
    }
    
    public function addEntity ($entity)
    {
        $value = IntrospectionUtils::getRecursivePropertyValue($entity, $this->valueFieldName);
        $label = IntrospectionUtils::getRecursivePropertyValue($entity, $this->displayFieldName);
        $this->addOption($value, $label);
    }
}

?>
