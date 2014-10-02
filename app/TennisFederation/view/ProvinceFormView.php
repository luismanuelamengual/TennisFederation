<?php

namespace TennisFederation\view;

use NeoPHP\web\html\Tag;
use TennisFederation\component\Button;
use TennisFederation\component\Form;
use TennisFederation\model\Province;
use TennisFederation\view\SiteView;

class ProvinceFormView extends SiteView
{
    private $province;
    
    public function setProvince (Province $province)
    {
        $this->province = $province;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), $this->province != null? "Edición de Provincia" : "Creación de Provincia"));
        $container->add ($this->createForm());
        return $container;
    }
    
    protected function createForm ()
    {
        $idHiddenField = new Tag("input", array("type"=>"hidden", "name"=>"provinceid"));
        $descriptionTextField = new Tag("input", array("placeholder"=>"Descripción", "type"=>"text", "class"=>"form-control", "name"=>"description"));
        if ($this->province != null)
        {
            $idHiddenField->setAttribute("value", $this->province->getId());
            $descriptionTextField->setAttribute("value", $this->province->getDescription());
        }
        
        $form = new Form(array("method"=>"post", "action"=>($this->province != null)? "updateProvince" : "createProvince"));
        $form->add($idHiddenField);
        $form->addField($descriptionTextField, "Descripción");
        $form->addButton(new Button("Guardar datos", array("class"=>"btn btn-primary")));
        return $form;
    }
}

?>