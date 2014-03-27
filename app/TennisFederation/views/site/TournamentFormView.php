<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\EntityCombobox;
use TennisFederation\components\Form;
use TennisFederation\models\Tournament;
use TennisFederation\views\site\SiteView;

class TournamentFormView extends SiteView
{
    private $tournament;
    private $countries;
    private $provinces;
    
    public function setTournament (Tournament $tournament)
    {
        $this->tournament = $tournament;
    }
    
    public function setCountries ($countries)
    {
        $this->countries = $countries;
    }
    
    public function setProvinces ($provinces)
    {
        $this->provinces = $provinces;
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
        $countryField = new EntityCombobox(array("placeholder"=>"País", "class"=>"form-control", "name"=>"countryid"), $this->countries);
        $provinceField = new EntityCombobox(array("placeholder"=>"Provincia", "class"=>"form-control", "name"=>"provinceid"), $this->provinces);
        if ($this->tournament != null)
        {
            $idHiddenField->setAttribute("value", $this->tournament->getId());
            $descriptionTextField->setAttribute("value", $this->tournament->getDescription());
            $countryField->setAttribute("value", $this->user->getCountry()->getId());
            $provinceField->setAttribute("value", $this->user->getProvince()->getId());
        }
        
        $form = new Form(array("method"=>"post", "action"=>($this->tournament != null)? "updateTournament" : "createTournament"));
        $form->add($idHiddenField);
        $form->addField($descriptionTextField, "Descripción");
        $form->addField($countryField, "País");
        $form->addField($provinceField, "Provincia");
        $form->addButton(new Button("Guardar datos", array("class"=>"btn btn-primary")));
        return $form;
    }
}

?>