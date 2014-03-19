<?php

namespace TennisFederation\components;

use NeoPHP\web\html\Tag;

class Form extends Tag
{
    const TYPE_BASIC = 0;
    const TYPE_INLINE = 1;
    const TYPE_HORIZONTAL = 2;
    
    private $type;
    
    public function __construct($type=self::TYPE_BASIC, $attributes = array())
    {
        parent::__construct("form", $attributes);
        $this->type = $type;
        switch ($this->type)
        {
            case self::TYPE_INLINE:
                $this->setAttribute("class", "form-inline");
                break;
            case self::TYPE_HORIZONTAL:
                $this->setAttribute("class", "form-horizontal"); 
                break;
        }
    }
    
    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
    
    public function addField ($field, $label=null)
    {
        switch ($this->type)
        {
            case self::TYPE_BASIC:
                $formgroup = new Tag("div", array("class"=>"form-group"));
                if (!empty($label))
                    $formgroup->add (new Tag("label", $label));
                $formgroup->add ($field);
                $this->add($formgroup);
                break;
            case self::TYPE_INLINE:
                $formgroup = new Tag("div", array("class"=>"form-group"));
                if (!empty($label))
                    $formgroup->add (new Tag("label", array("class"=>"sr-only"), $label));
                $formgroup->add ($field);
                $this->add($formgroup);
                break;
            case self::TYPE_HORIZONTAL:
                $formgroup = new Tag("div", array("class"=>"form-group"));
                if (!empty($label))
                {
                    $formgroup->add (new Tag("label", array("class"=>"col-sm-2 control-label"), $label));
                    $formgroup->add (new Tag("div", array("class"=>"col-sm-10"), $field));
                }
                else
                {
                    $formgroup->add (new Tag("div", array("class"=>"col-sm-12"), $field));
                }
                $this->add($formgroup);
                break;
        }
    }
    
    public function addButton (Button $button)
    {
        switch ($this->type)
        {
            case self::TYPE_BASIC:
            case self::TYPE_INLINE:
                $this->add($button);
                break;
            case self::TYPE_HORIZONTAL:
                $this->add(new Tag("div", array("class"=>"form-group"), new Tag("div", array("class"=>"col-sm-offset-2 col-sm-10"), $button)));
                break;
        }
    }
}

?>
