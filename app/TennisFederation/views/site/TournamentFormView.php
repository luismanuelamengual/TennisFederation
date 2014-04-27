<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\DatetimePicker;
use TennisFederation\components\EntityCombobox;
use TennisFederation\components\Form;
use TennisFederation\models\Tournament;
use TennisFederation\views\site\SiteView;

class TournamentFormView extends SiteView
{
    private $tournament;
    private $clubs;
    
    public function setTournament (Tournament $tournament)
    {
        $this->tournament = $tournament;
    }
    
    public function setClubs ($clubs)
    {
        $this->clubs = $clubs;
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
        if ($this->tournament != null)
        {
            $idHiddenField->setAttribute("value", $this->tournament->getId());
            $descriptionTextField->setAttribute("value", $this->tournament->getDescription());
            $clubField->setAttribute("value", $this->tournament->getClub()->getId());
            $startDateField->setAttribute("value", $this->tournament->getStartDate());
            $inscriptionDateField->setAttribute("value", $this->tournament->getInscriptionsDate());
        }
        
        $form = new Form(array("method"=>"post", "action"=>($this->tournament != null)? "updateTournament" : "createTournament"));
        $form->setColumns(2);
        $form->add($idHiddenField);
        $form->addField($descriptionTextField, "Descripción");
        $form->addField($clubField, "Club");
        $form->addField($startDateField, "Fecha de inicio");
        $form->addField($inscriptionDateField, "Fecha de cierre de inscripción");
        $form->addButton(new Button("Guardar datos", array("class"=>"btn btn-primary")));
        return $form;
    }
}

?>