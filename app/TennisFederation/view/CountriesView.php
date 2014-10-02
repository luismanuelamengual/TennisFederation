<?php

namespace TennisFederation\view;

use NeoPHP\web\html\Tag;
use TennisFederation\component\Button;
use TennisFederation\component\EntityTable;
use TennisFederation\view\SiteView;

class CountriesView extends SiteView
{
    private $countries = array();
    
    public function setCountries ($countries)
    {
        $this->countries = $countries;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), "Administración de Paises"));
        $container->add ($this->createButtonToolbar());
        $container->add ($this->createCountriesTable());
        return $container;
    }
    
    protected function createButtonToolbar()
    {
        $toolbar = new Tag("ul", array("class"=>"nav nav-pills"));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-file"></span>&nbsp;Crear', array("class"=>"btn btn-primary", "onclick"=>"createCountry();"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifiar', array("id"=>"updateButton", "class"=>"btn btn-primary", "onclick"=>"updateCountry();", "disabled"=>"true"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar', array("id"=>"deleteButton", "class"=>"btn btn-primary", "onclick"=>"deleteCountry();", "disabled"=>"true"))));
        return $toolbar;
    }
    
    protected function createCountriesTable()
    {
        $table = new EntityTable(array("id"=>"countriesTable"));
        $table->addColumn ("#", "id");
        $table->addColumn ("Nombre", "description");
        $table->setEntities($this->countries);
        $table->addEntityProperty("countryId", "id");
        return $table;
    }
    
    protected function addScripts ()
    {
        parent::addScripts();
        $this->addScript ('
            function getSelectedCountryId ()
            {
                var selectedRows = $("#countriesTable > tbody > tr.danger"); 
                return (selectedRows.length > 0)? selectedRows.first().attr("countryId") : false;
            }
            
            function selectCountry (countryId)
            {
                $("tr[countryId=" + countryId + "]").addClass("danger").siblings().removeClass("danger");
                $("#updateButton").prop("disabled",false); 
                $("#deleteButton").prop("disabled",false);
            }

            function createCountry ()
            {
                window.open("' . $this->getUrl("site/country/showCountryForm") . '", "_self");
            }
            
            function updateCountry ()
            {
                var selectedCountryId = getSelectedCountryId();
                if (selectedCountryId != false)
                    window.open("' . $this->getUrl("site/country/showCountryForm") . '?countryid=" + selectedCountryId, "_self");
            }
            
            function deleteCountry ()
            {
                var selectedCountryId = getSelectedCountryId();
                if (selectedCountryId != false)
                    if (window.confirm("Esta seguro de eliminar la categoría " + selectedCountryId + " ?"))
                        window.open("' . $this->getUrl("site/country/deleteCountry") . '?countryid=" + selectedCountryId, "_self");
            }
        ');
        
        $this->addOnDocumentReadyScript('
            var tableRows = $("#countriesTable > tbody > tr");
            tableRows.on("click", function(event) { selectCountry($(this).attr("countryId")); });
            tableRows.on("dblclick", function(event) { updateCountry(); });
        ');
    }
}

?>