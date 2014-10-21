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
    
    protected function build()
    {
        parent::build();
        $this->addScript('
            $("#countriesTable tr").on(
            {
                click: function (e) 
                {
                    $("#countriesTable tr").removeClass("danger");
                    $(this).addClass("danger");
                    $("#updateButton").prop("disabled",false); 
                    $("#deleteButton").prop("disabled",false); 
                },
                dblclick: function (e)
                {
                    var id = $(this).attr("countryId");
                    window.open("showCountryForm?countryid=" + id, "_self");
                }
            });
            $("#createButton").click(function (e) 
            {
                window.open("showCountryForm", "_self");
            });
            $("#updateButton").click(function (e) 
            {
                var id = $("#countriesTable tr.danger").attr("countryId");
                window.open("showCountryForm?countryid=" + id, "_self");
            });
            $("#deleteButton").click(function (e) 
            {
                var id = $("#countriesTable tr.danger").attr("countryId");
                if (window.confirm("Esta seguro de eliminar el pais " + id + " ?"))
                    window.open("deleteCountry?countryid=" + id, "_self");
            });
        ');
    }
    
    protected function createContent() 
    {
        $container = new Tag("div", array("class"=>"container"));
        $container->add (new Tag("h2", array("class"=>"page-header"), "Administración de Paises"));
        $container->add ($this->createButtonToolbar());
        $container->add ($this->createCountriesTable());
        return $container;
    }
    
    protected function createButtonToolbar()
    {
        $toolbar = new Tag("ul", array("class"=>"nav nav-pills"));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-file"></span>&nbsp;Crear', array("id"=>"createButton", "class"=>"btn btn-primary"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifiar', array("id"=>"updateButton", "class"=>"btn btn-primary", "disabled"=>"true"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar', array("id"=>"deleteButton", "class"=>"btn btn-primary", "disabled"=>"true"))));
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
}

?>