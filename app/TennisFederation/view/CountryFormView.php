<?php

namespace TennisFederation\view;

use NeoPHP\web\html\Tag;
use TennisFederation\component\Button;
use TennisFederation\component\Form;
use TennisFederation\model\Country;

class CountryFormView extends SiteView
{
    private $country;
    
    public function setCountry (Country $country)
    {
        $this->country = $country;
    }
    
    protected function createContent() 
    {
        $container = new Tag("div", array("class"=>"container"));
        $container->add (new Tag("h2", array("class"=>"page-header"), $this->country != null? "Edición de Pais" : "Creación de Pais"));
        $container->add ($this->createForm());
        return $container;
    }
    
    protected function createForm ()
    {
        $idHiddenField = new Tag("input", array("type"=>"hidden", "name"=>"countryid"));
        $descriptionTextField = new Tag("input", array("placeholder"=>"Descripción", "type"=>"text", "class"=>"form-control", "name"=>"description"));
        if ($this->country != null)
        {
            $idHiddenField->setAttribute("value", $this->country->getId());
            $descriptionTextField->setAttribute("value", $this->country->getDescription());
        }
        
        $form = new Form(array("method"=>"post", "action"=>($this->country != null)? "updateCountry" : "createCountry"));
        $form->add($idHiddenField);
        $form->addField($descriptionTextField, array("label"=>"Descripción"));
        $form->add(new Button("Guardar datos", array("type"=>"submit", "class"=>"btn btn-primary")));
        return $form;
    }
}

?>