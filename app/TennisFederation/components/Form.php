<?php

namespace TennisFederation\components;

use NeoPHP\web\html\HTMLComponent;
use NeoPHP\web\html\Tag;
use stdClass;

class Form extends HTMLComponent
{
    const TYPE_BASIC = 0;
    const TYPE_INLINE = 1;
    const TYPE_HORIZONTAL = 2;
    
    private $attributes;
    private $type;
    private $fields;
    private $buttons;
    
    public function __construct($attributes = array())
    {
        $this->attributes = $attributes;
        $this->type = self::TYPE_BASIC;
        $this->fields = array();
        $this->buttons = array();
    }
    
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
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
        $fieldObject = new stdClass();
        $fieldObject->field = $field;
        $fieldObject->label = $label;
        $this->fields[] = $fieldObject;
    }
    
    public function addButton (Button $button)
    {
        $this->buttons[] = $button;
    }
    
    protected function createContent ()
    {
        $form = new Tag("form", array_merge(array("role"=>"form"), $this->attributes));
        switch ($this->type)
        {
            case self::TYPE_BASIC:
                foreach ($this->fields as $field)
                {
                    $formgroup = new Tag("div", array("class"=>"form-group"));
                    if (!empty($field->label))
                        $formgroup->add (new Tag("label", $field->label));
                    $formgroup->add ($field->field);
                    $form->add($formgroup);
                }
                foreach ($this->buttons as $button)
                    $form->add($button);
                break;
            case self::TYPE_INLINE:
                $form->setAttribute("class", "form-inline");
                foreach ($this->fields as $field)
                {
                    $formgroup = new Tag("div", array("class"=>"form-group"));
                    if (!empty($field->label))
                        $formgroup->add (new Tag("label", array("class"=>"sr-only"), $field->label));
                    $formgroup->add ($field->field);
                    $form->add($formgroup);
                }
                foreach ($this->buttons as $button)
                    $form->add($button);
                break;
            case self::TYPE_HORIZONTAL:
                $form->setAttribute("class", "form-horizontal");
                foreach ($this->fields as $field)
                {
                    $formgroup = new Tag("div", array("class"=>"form-group"));
                    if (!empty($field->label))
                    {
                        $formgroup->add (new Tag("label", array("class"=>"col-sm-2 control-label"), $field->label));
                        $formgroup->add (new Tag("div", array("class"=>"col-sm-10"), $field->field));
                    }
                    else
                    {
                        $formgroup->add (new Tag("div", array("class"=>"col-sm-12"), $field->field));
                    }
                    $form->add($formgroup);
                }
                foreach ($this->buttons as $button)
                    $form->add(new Tag("div", array("class"=>"form-group"), new Tag("div", array("class"=>"col-sm-offset-2 col-sm-10"), $button)));
                break;
        }
        return $form;
    }
}

?>
