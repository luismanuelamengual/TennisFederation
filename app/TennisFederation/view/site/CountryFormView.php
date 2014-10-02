<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\Form;
use TennisFederation\models\Country;
use TennisFederation\views\site\SiteView;

class CountryFormView extends SiteView
{
    private $country;
    
    public function setCountry (Country $country)
    {
        $this->country = $country;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), $this->country != null? "Edición de Pais" : "Creación de Pais"));
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
        $form->addField($descriptionTextField, "Descripción");
        $form->addButton(new Button("Guardar datos", array("class"=>"btn btn-primary")));
        return $form;
    }
}

?>