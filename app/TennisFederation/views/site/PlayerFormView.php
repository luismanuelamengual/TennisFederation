<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\DatetimePicker;
use TennisFederation\components\Form;
use TennisFederation\models\Player;
use TennisFederation\views\site\SiteView;

class PlayerFormView extends SiteView
{
    private $player;
    
    public function setPlayer (Player $player)
    {
        $this->player = $player;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), $this->player != null? "Edición de Jugador" : "Creación de Jugador"));
        $container->add ($this->createForm());
        return $container;
    }
    
    protected function createForm ()
    {
        $idHiddenField = new Tag("input", array("type"=>"hidden", "name"=>"playerid"));
        $usernameTextField = new Tag("input", array("placeholder"=>"Nombre de Usuario", "type"=>"text", "class"=>"form-control", "name"=>"username"));
        $passwordTextField = new Tag("input", array("placeholder"=>"Contraseña", "type"=>"password", "class"=>"form-control", "name"=>"password"));
        $passwordRepeatTextField = new Tag("input", array("placeholder"=>"Contraseña (Rep)", "type"=>"password", "class"=>"form-control", "name"=>"passwordrepeat"));
        $firstnameTextField = new Tag("input", array("placeholder"=>"Nombre", "type"=>"text", "class"=>"form-control", "name"=>"firstname"));
        $lastnameTextField = new Tag("input", array("placeholder"=>"Apellido", "type"=>"text", "class"=>"form-control", "name"=>"lastname"));
        $birthDateField = new DatetimePicker($this, array("placeholder"=>"Fecha de nacimiento", "type"=>"text", "name"=>"birthdate"));
        $documentTextField = new Tag("input", array("placeholder"=>"Número de Documento", "type"=>"text", "class"=>"form-control", "name"=>"documentnumber"));
        $addressTextField = new Tag("input", array("placeholder"=>"Dirección", "type"=>"text", "class"=>"form-control", "name"=>"address"));
        $birthDateField->setTimeEnabled(false);
        if ($this->player != null)
        {
            $idHiddenField->setAttribute("value", $this->player->getId());
            $usernameTextField->setAttribute("value", $this->player->getUsername());
            $passwordTextField->setAttribute("value", $this->player->getPassword());
            $passwordRepeatTextField->setAttribute("value", $this->player->getPassword());
            $firstnameTextField->setAttribute("value", $this->player->getFirstname());
            $lastnameTextField->setAttribute("value", $this->player->getLastname());
            $birthDateField->setAttribute("value", $this->player->getBirthDate());
            $documentTextField->setAttribute("value", $this->player->getDocumentNumber());
            $addressTextField->setAttribute("value", $this->player->getAddress());
        }
        
        $form = new Form(Form::TYPE_HORIZONTAL, array("method"=>"post", "action"=>($this->player != null)? "updatePlayer" : "createPlayer"));
        $form->add($idHiddenField);
        $form->addField($usernameTextField, "Nombre de Usuario");
        $form->addField($passwordTextField, "Contraseña");
        $form->addField($passwordRepeatTextField, "Contraseña (Rep)");  
        $form->addField($firstnameTextField, "Nombre");
        $form->addField($lastnameTextField, "Apellido");
        $form->addField($birthDateField, "Fecha de Nacimiento");
        $form->addField($documentTextField, "Número de Documento");
        $form->addField($addressTextField, "Dirección");
        $form->addButton(new Button("Guardar datos", array("class"=>"btn btn-primary")));
        return $form;
    }
}

?>