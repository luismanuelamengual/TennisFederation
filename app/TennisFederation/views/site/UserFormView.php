<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\DatetimePicker;
use TennisFederation\components\EntityCombobox;
use TennisFederation\components\Form;
use TennisFederation\models\User;
use TennisFederation\views\site\SiteView;

class UserFormView extends SiteView
{
    private $user;
    private $usertypes;
    private $countries;
    private $provinces;
    private $clubs;
    private $myAccountMode = false;
    
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
            
            function validateBirthdate ()
            {
                var valid = true;
                var $birthdateField = $("input[name=birthdate]");
                var value = $birthdateField[0].value.trim();
                if (value != "" && !value.match(/^(\d{4})([\/-])(\d{1,2})\2(\d{1,2})$/))
                {
                    addFieldError("birthdate", "El campo de fecha no contiene un valor valido");
                    valid = false;
                }
                return valid;
            }
            
            function validateUsername ()
            {
                var valid = true;
                var $usernameField = $("input[name=username]");
                var username = $usernameField[0].value;
                var response = $.ajax(
                {
                    type: "GET",
                    url: "' . $this->getUrl("site/user/checkUsername") . '?username=" + username,
                    async: false
                }).responseText;
                if (response == "true")
                {
                    addFieldError("username", "El nombre de usuario ya existe");
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
                valid = valid & validateBirthdate();
                ' . ($this->user != null? '' : 'valid = valid & validateUsername();') . '
                valid = valid & validatePasswords();
                

                console.log("Valid: " + valid);

                if (valid == 0) valid = false;
                return valid;
            }
        ');
    }
    
    public function setMyAccountMode ($myAccountMode)
    {
        $this->myAccountMode = $myAccountMode;
    }
    
    public function setUser (User $user)
    {
        $this->user = $user;
    }
    
    public function setUserTypes ($usertypes)
    {
        $this->usertypes = $usertypes;
    }
    
    public function setCountries ($countries)
    {
        $this->countries = $countries;
    }
    
    public function setProvinces ($provinces)
    {
        $this->provinces = $provinces;
    }
    
    public function setClubs ($clubs)
    {
        $this->clubs = $clubs;
    }
    
    protected function createMainContent() 
    {
        $title = $this->user != null? "Edición de Usuario" : "Creación de Usuario";
        if ($this->myAccountMode)
            $title = "Mi Cuenta";
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), $title));
        $container->add ($this->createForm());
        return $container;
    }
    
    protected function createForm ()
    {
        $idHiddenField = new Tag("input", array("type"=>"hidden", "name"=>"userid"));
        if (!$this->myAccountMode)
            $userTypeField = new EntityCombobox(array("placeholder"=>"Tipo de usuario", "class"=>"form-control", "name"=>"usertypeid"), $this->usertypes);
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
        $clubField = new EntityCombobox(array("placeholder"=>"Club", "class"=>"form-control", "name"=>"clubid"), $this->clubs);
        $addressTextField = new Tag("input", array("placeholder"=>"Dirección", "type"=>"text", "class"=>"form-control", "name"=>"address"));
        $contactVia1TextField = new Tag("input", array("placeholder"=>"Telefono 1", "type"=>"text", "class"=>"form-control", "name"=>"contactvia1"));
        $contactVia2TextField = new Tag("input", array("placeholder"=>"Telefono 2", "type"=>"text", "class"=>"form-control", "name"=>"contactvia2"));
        $contactVia3TextField = new Tag("input", array("placeholder"=>"Telefono 3", "type"=>"text", "class"=>"form-control", "name"=>"contactvia3"));
        $emailTextField = new Tag("input", array("placeholder"=>"E-mail", "type"=>"text", "class"=>"form-control", "name"=>"email"));
        if ($this->user != null)
        {
            $idHiddenField->setAttribute("value", $this->user->getId());
            if (!$this->myAccountMode)
                $userTypeField->setAttribute("value", $this->user->getType()->getId());
            $usernameTextField->setAttribute("value", $this->user->getUsername());
            if ($this->myAccountMode)
                $usernameTextField->setAttribute("disabled", true);
            $passwordTextField->setAttribute("value", $this->user->getPassword());
            $passwordRepeatTextField->setAttribute("value", $this->user->getPassword());
            $firstnameTextField->setAttribute("value", $this->user->getFirstname());
            $lastnameTextField->setAttribute("value", $this->user->getLastname());
            $birthDateField->setAttribute("value", $this->user->getBirthDate());
            $documentTextField->setAttribute("value", $this->user->getDocumentNumber());
            $countryField->setAttribute("value", $this->user->getCountry()->getId());
            $provinceField->setAttribute("value", $this->user->getProvince()->getId());
            $clubField->setAttribute("value", $this->user->getClub()->getId());
            $addressTextField->setAttribute("value", $this->user->getAddress());
            $contactVia1TextField->setAttribute("value", $this->user->getContactVia1());
            $contactVia2TextField->setAttribute("value", $this->user->getContactVia2());
            $contactVia3TextField->setAttribute("value", $this->user->getContactVia3());
            $emailTextField->setAttribute("value", $this->user->getEmail());
        }

        $action = ($this->user != null)? "updateUser" : "createUser";
        if ($this->myAccountMode)
            $action = "myAccountSave";
        $form = new Form(array("method"=>"post", "enctype"=>"multipart/form-data", "action"=>$action));
        $form->setColumns(2);
        $form->add($idHiddenField);
        if (!$this->myAccountMode)
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
        $form->addField($clubField, "Club");
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