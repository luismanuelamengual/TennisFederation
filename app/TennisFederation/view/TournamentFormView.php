<?php

namespace TennisFederation\view;

use NeoPHP\web\html\Tag;
use TennisFederation\component\Button;
use TennisFederation\component\DatetimePicker;
use TennisFederation\component\EntityCombobox;
use TennisFederation\component\Form;
use TennisFederation\model\Tournament;
use TennisFederation\view\SiteView;

class TournamentFormView extends SiteView
{
    private $tournament;
    private $clubs;
    private $categories;
    
    public function setTournament (Tournament $tournament)
    {
        $this->tournament = $tournament;
    }
    
    public function setClubs ($clubs)
    {
        $this->clubs = $clubs;
    }
    
    public function setCategories ($categories)
    {
        $this->categories = $categories;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), $this->tournament != null? "Edición de Torneo" : "Creación de Torneo"));
        $container->add ($this->createForm());
        return $container;
    }
    
    protected function createForm ()
    {
        $idHiddenField = new Tag("input", array("type"=>"hidden", "name"=>"tournamentid"));
        $descriptionTextField = new Tag("input", array("placeholder"=>"Descripción", "type"=>"text", "class"=>"form-control", "name"=>"description"));
        $clubField = new EntityCombobox(array("placeholder"=>"Club", "class"=>"form-control", "name"=>"clubid"), $this->clubs);
        $startDateField = new DatetimePicker($this, array("placeholder"=>"Fecha de inicio", "name"=>"startdate"));
        $startDateField->setTimeEnabled(false);
        $inscriptionDateField = new DatetimePicker($this, array("placeholder"=>"Fecha de cierre de inscripción", "name"=>"inscriptionsdate"));
        $inscriptionDateField->setTimeEnabled(false);
        $categoriesField = new EntityCombobox(array("placeholder"=>"Categorías", "class"=>"form-control", "name"=>"categories[]", "multiple"=>"true"), $this->categories);
        if ($this->tournament != null)
        {
            $idHiddenField->setAttribute("value", $this->tournament->getId());
            $descriptionTextField->setAttribute("value", $this->tournament->getDescription());
            $clubField->setAttribute("value", $this->tournament->getClub()->getId());
            $startDateField->setAttribute("value", $this->tournament->getStartDate());
            $inscriptionDateField->setAttribute("value", $this->tournament->getInscriptionsDate());
            $categories = array();
            foreach ($this->tournament->getCategories() as $category)
                $categories[] = $category->getId();
            if (sizeof($categories) > 0)
                $categoriesField->setAttribute("value", $categories);
        }
        
        $form = new Form(array("method"=>"post", "action"=>($this->tournament != null)? "updateTournament" : "createTournament"));
        $form->setColumns(2);
        $form->add($idHiddenField);
        $form->addField($descriptionTextField, "Descripción");
        $form->addField($clubField, "Club");
        $form->addField($startDateField, "Fecha de inicio");
        $form->addField($inscriptionDateField, "Fecha de cierre de inscripción");
        $form->addField($categoriesField, "Categorias");
        $form->addButton(new Button("Guardar datos", array("class"=>"btn btn-primary")));
        return $form;
    }
}

?>