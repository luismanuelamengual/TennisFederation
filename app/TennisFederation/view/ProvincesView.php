<?php

namespace TennisFederation\view;

use NeoPHP\web\html\Tag;
use TennisFederation\component\Button;
use TennisFederation\component\EntityTable;
use TennisFederation\view\SiteView;

class ProvincesView extends SiteView
{
    private $provinces = array();
    
    public function setProvinces ($provinces)
    {
        $this->provinces = $provinces;
    }
    
    protected function build()
    {
        parent::build();
        $this->addScript('
            $("#provincesTable tr").on(
            {
                click: function (e) 
                {
                    $("#provincesTable tr").removeClass("danger");
                    $(this).addClass("danger");
                    $("#updateButton").prop("disabled",false); 
                    $("#deleteButton").prop("disabled",false); 
                },
                dblclick: function (e)
                {
                    var id = $(this).attr("provinceId");
                    window.open("showProvinceForm?provinceid=" + id, "_self");
                }
            });
            $("#createButton").click(function (e) 
            {
                window.open("showProvinceForm", "_self");
            });
            $("#updateButton").click(function (e) 
            {
                var id = $("#provincesTable tr.danger").attr("provinceId");
                window.open("showProvinceForm?provinceid=" + id, "_self");
            });
            $("#deleteButton").click(function (e) 
            {
                var id = $("#provincesTable tr.danger").attr("provinceId");
                if (window.confirm("Esta seguro de eliminar la provincia " + id + " ?"))
                    window.open("deleteProvince?provinceid=" + id, "_self");
            });
        ');
    }
    
    protected function createContent() 
    {
        $container = new Tag("div", array("class"=>"container"));
        $container->add (new Tag("h2", array("class"=>"page-header"), "Administración de Provincias"));
        $container->add ($this->createButtonToolbar());
        $container->add ($this->createProvincesTable());
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
    
    protected function createProvincesTable()
    {
        $table = new EntityTable(array("id"=>"provincesTable"));
        $table->addColumn ("#", "id");
        $table->addColumn ("Nombre", "description");
        $table->setEntities($this->provinces);
        $table->addEntityProperty("provinceId", "id");
        return $table;
    }
}

?>