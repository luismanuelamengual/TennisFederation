<?php

namespace TennisFederation\view;

use NeoPHP\web\html\Tag;
use TennisFederation\component\Button;
use TennisFederation\component\Form;
use TennisFederation\model\Club;
use TennisFederation\view\SiteView;

class ClubFormView extends SiteView
{
    private $club;
    
    public function setClub (Club $club)
    {
        $this->club = $club;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), $this->club != null? "Edición de Club" : "Creación de Club"));
        $container->add ($this->createForm());
        return $container;
    }
    
    protected function createForm ()
    {
        $idHiddenField = new Tag("input", array("type"=>"hidden", "name"=>"clubid"));
        $descriptionTextField = new Tag("input", array("placeholder"=>"Descripción", "type"=>"text", "class"=>"form-control", "name"=>"description"));
        $addressTextField = new Tag("input", array("placeholder"=>"Dirección", "type"=>"text", "class"=>"form-control", "name"=>"address"));
        $contactvia1TextField = new Tag("input", array("placeholder"=>"Teléfono 1", "type"=>"text", "class"=>"form-control", "name"=>"contactvia1"));
        $contactvia2TextField = new Tag("input", array("placeholder"=>"Teléfono 2", "type"=>"text", "class"=>"form-control", "name"=>"contactvia2"));
        if ($this->club != null)
        {
            $idHiddenField->setAttribute("value", $this->club->getId());
            $descriptionTextField->setAttribute("value", $this->club->getDescription());
            $addressTextField->setAttribute("value", $this->club->getAddress());
            $contactvia1TextField->setAttribute("value", $this->club->getContactvia1());
            $contactvia2TextField->setAttribute("value", $this->club->getContactvia2());
        }
        
        $form = new Form(array("method"=>"post", "action"=>($this->club != null)? "updateClub" : "createClub"));
        $form->add($idHiddenField);
        $form->addField($descriptionTextField, "Descripción");
        $form->addField($addressTextField, "Dirección");
        $form->addField($contactvia1TextField, "Teléfono 1");
        $form->addField($contactvia2TextField, "Teléfono 2");
        $form->addButton(new Button("Guardar datos", array("class"=>"btn btn-primary")));
        return $form;
    }
}

?>