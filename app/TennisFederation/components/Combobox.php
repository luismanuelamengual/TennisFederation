<?php

namespace TennisFederation\components;

use NeoPHP\web\html\HTMLView;
use NeoPHP\web\html\Tag;

class Combobox extends Tag
{
    public function __construct(HTMLView $view, $attributes=array(), $options=array())
    {
        static $counter = 0;
        $id = isset($attributes["id"])? $attributes["id"] : "combobox_" . ($counter++);
        parent::__construct("select", array_merge(array("id"=>$id, "class"=>"form-control"), $attributes));
        $this->addOptions($options);
    }
    
    public function addOption ($value, $label)
    {
        $this->add(new Tag("option", array("value"=>$value), $label));
    }
    
    public function addOptions ($options)
    {
        foreach ($options as $value=>$label)
            $this->addOption ($value, $label);
    }
}

?>