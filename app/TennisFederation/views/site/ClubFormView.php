<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\Form;
use TennisFederation\models\Club;
use TennisFederation\views\site\SiteView;

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
        if ($this->club != null)
        {
            $idHiddenField->setAttribute("value", $this->club->getId());
            $descriptionTextField->setAttribute("value", $this->club->getDescription());
        }
        
        $form = new Form(Form::TYPE_HORIZONTAL, array("method"=>"post", "action"=>($this->club != null)? "updateClub" : "createClub"));
        $form->add($idHiddenField);
        $form->addField($descriptionTextField, "Descripción");
        $form->addButton(new Button("Guardar datos", array("class"=>"btn btn-primary")));
        return $form;
    }
}

?>