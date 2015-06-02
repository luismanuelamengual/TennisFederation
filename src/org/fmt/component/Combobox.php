<?php

namespace org\fmt\component;

use NeoPHP\web\html\Tag;

class Combobox extends Tag
{
    public function __construct($attributes=array(), $options=array())
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
    
    public function setAttribute($key, $value)
    {
        if ($key == "value")
        {
            $content = $this->getContent();
            foreach ($content as $optionTag)
            {
                if (is_array($value)? array_search($optionTag->getAttribute("value"), $value) !== false : $optionTag->getAttribute("value") == $value)
                {
                    $optionTag->setAttribute("selected", true);
                }
            }
        }
        else
        {
            parent::setAttribute($key, $value);
        }
    }
    
    public function addOptions ($options)
    {
        foreach ($options as $value=>$label)
            $this->addOption ($value, $label);
    }
}

?>