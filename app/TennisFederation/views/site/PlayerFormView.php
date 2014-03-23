<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\DatetimePicker;
use TennisFederation\components\EntityCombobox;
use TennisFederation\components\Form;
use TennisFederation\models\Player;
use TennisFederation\views\site\SiteView;

class PlayerFormView extends SiteView
{
    private $player;
    private $playertypes;
    private $countries;
    private $provinces;
    
    protected function addScripts ()
    {
        parent::addScripts();
        $this->addScript('
            function removeAllFieldsErrors ()
            {
                $(".form-group").removeClass("has-error");
                $messages = $(".form-group p");
                $messages.addClass("hidden");
                $messages.html("");
            }

            function addFieldError (fieldName, error)
            {
                var $field = $("input[name=" + fieldName + "]");
                var $fieldFormGroup = $field.closest(".form-group");
                var $messageText = $fieldFormGroup.find("p");
                if (!$fieldFormGroup.hasClass("has-error"))
                    $fieldFormGroup.addClass("has-error");
                if ($messageText.hasClass("hidden"))
                    $messageText.removeClass("hidden");
                    
                var messages = $messageText.html();
                if (messages != "")
                    messages += "<br>";
                messages += error;
                $messageText.html(messages);
            }

            function validateEmptyField (fieldName)
            {
                var valid = true;
                var $field = $("input[name=" + fieldName + "]");
                var $fieldFormGroup = $field.closest(".form-group");
                if ($field[0].value.trim() == "")
                {
                    addFieldError(fieldName, "El campo es requerido");
                    valid = false;
                }
                return valid;
            }
            
            function validatePasswords ()
            {
                var valid = true;
                var $passwordField = $("input[name=password]");
                var $passwordRepeatField = $("input[name=passwordrepeat]");
                if ($passwordField[0].value != $passwordRepeatField[0].value)
                {
                    addFieldError("password", "Los campos de contraseñas deben coincidir");
                    addFieldError("passwordrepeat", "Los campos de contraseñas deben coincidir");
                    valid = false;
                }
                return valid;
            }

            function validateFields ()
            {
                var valid = true;
                removeAllFieldsErrors();
                valid = valid & validateEmptyField("username");
                valid = valid & validateEmptyField("password");
                valid = valid & validateEmptyField("passwordrepeat");
                valid = valid & validateEmptyField("firstname");
                valid = valid & validateEmptyField("lastname");
                valid = valid & validatePasswords();
                if (valid == 0) valid = false;
                return valid;
            }
        ');
    }
    
    public function setPlayer (Player $player)
    {
        $this->player = $player;
    }
    
    public function setPlayerTypes ($playertypes)
    {
        $this->playertypes = $playertypes;
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
        $container->add (new Tag("h1", array("class"=>"page-header"), $this->player != null? "Edición de Jugador" : "Creación de Jugador"));
        $container->add ($this->createForm());
        return $container;
    }
    
    protected function createForm ()
    {
        $idHiddenField = new Tag("input", array("type"=>"hidden", "name"=>"playerid"));
        $userTypeField = new EntityCombobox(array("placeholder"=>"Tipo de usuario", "class"=>"form-control", "name"=>"playertypeid"), $this->playertypes);
        $usernameTextField = new Tag("input", array("placeholder"=>"Nombre de Usuario", "type"=>"text", "class"=>"form-control", "name"=>"username"));
        $passwordTextField = new Tag("input", array("placeholder"=>"Contraseña", "type"=>"password", "class"=>"form-control", "name"=>"password"));
        $passwordRepeatTextField = new Tag("input", array("placeholder"=>"Contraseña (Rep)", "type"=>"password", "class"=>"form-control", "name"=>"passwordrepeat"));
        $firstnameTextField = new Tag("input", array("placeholder"=>"Nombre", "type"=>"text", "class"=>"form-control", "name"=>"firstname"));
        $lastnameTextField = new Tag("input", array("placeholder"=>"Apellido", "type"=>"text", "class"=>"form-control", "name"=>"lastname"));
        $birthDateField = new DatetimePicker($this, array("placeholder"=>"Fecha de nacimiento", "name"=>"birthdate"));
        $documentTextField = new Tag("input", array("placeholder"=>"Número de Documento", "type"=>"text", "class"=>"form-control", "name"=>"documentnumber"));
        $birthDateField->setTimeEnabled(false);
        $countryField = new EntityCombobox(array("placeholder"=>"País", "class"=>"form-control", "name"=>"countryid"), $this->countries);
        $provinceField = new EntityCombobox(array("placeholder"=>"Provincia", "class"=>"form-control", "name"=>"provinceid"), $this->provinces);
        $addressTextField = new Tag("input", array("placeholder"=>"Dirección", "type"=>"text", "class"=>"form-control", "name"=>"address"));
        $contactVia1TextField = new Tag("input", array("placeholder"=>"Telefono 1", "type"=>"text", "class"=>"form-control", "name"=>"contactvia1"));
        $contactVia2TextField = new Tag("input", array("placeholder"=>"Telefono 2", "type"=>"text", "class"=>"form-control", "name"=>"contactvia2"));
        $contactVia3TextField = new Tag("input", array("placeholder"=>"Telefono 3", "type"=>"text", "class"=>"form-control", "name"=>"contactvia3"));
        $emailTextField = new Tag("input", array("placeholder"=>"E-mail", "type"=>"text", "class"=>"form-control", "name"=>"email"));
        if ($this->player != null)
        {
            $idHiddenField->setAttribute("value", $this->player->getId());
            $userTypeField->setAttribute("value", $this->player->getType()->getId());
            $usernameTextField->setAttribute("value", $this->player->getUsername());
            $passwordTextField->setAttribute("value", $this->player->getPassword());
            $passwordRepeatTextField->setAttribute("value", $this->player->getPassword());
            $firstnameTextField->setAttribute("value", $this->player->getFirstname());
            $lastnameTextField->setAttribute("value", $this->player->getLastname());
            $birthDateField->setAttribute("value", $this->player->getBirthDate());
            $documentTextField->setAttribute("value", $this->player->getDocumentNumber());
            $countryField->setAttribute("value", $this->player->getCountry()->getId());
            $provinceField->setAttribute("value", $this->player->getProvince()->getId());
            $addressTextField->setAttribute("value", $this->player->getAddress());
            $contactVia1TextField->setAttribute("value", $this->player->getContactVia1());
            $contactVia2TextField->setAttribute("value", $this->player->getContactVia2());
            $contactVia3TextField->setAttribute("value", $this->player->getContactVia3());
            $emailTextField->setAttribute("value", $this->player->getEmail());
        }
        
        $form = new Form(array("method"=>"post", "action"=>($this->player != null)? "updatePlayer" : "createPlayer"));
        $form->setColumns(2);
        $form->add($idHiddenField);
        $form->addField($userTypeField, "Tipo de usuario");
        $form->addField($usernameTextField, "Nombre de Usuario");
        $form->addField($passwordTextField, "Contraseña");
        $form->addField($passwordRepeatTextField, "Contraseña (Rep)");  
        $form->addField($firstnameTextField, "Nombre");
        $form->addField($lastnameTextField, "Apellido");
        $form->addField($birthDateField, "Fecha de Nacimiento");
        $form->addField($documentTextField, "Número de Documento");
        $form->addField($countryField, "País");
        $form->addField($provinceField, "Provincia");
        $form->addField($addressTextField, "Dirección");
        $form->addField($contactVia1TextField, "Telefono 1");
        $form->addField($contactVia2TextField, "Telefono 2");
        $form->addField($contactVia3TextField, "Telefono 3");
        $form->addField($emailTextField, "E-mail");
        $form->addButton(new Button("Guardar datos", array("class"=>"btn btn-primary", "onclick"=>"return validateFields();")));
        return $form;
    }
}

?>