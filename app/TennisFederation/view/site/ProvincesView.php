<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\EntityTable;
use TennisFederation\views\site\SiteView;

class ProvincesView extends SiteView
{
    private $provinces = array();
    
    public function setProvinces ($provinces)
    {
        $this->provinces = $provinces;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), "Administración de Provincias"));
        $container->add ($this->createButtonToolbar());
        $container->add ($this->createProvincesTable());
        return $container;
    }
    
    protected function createButtonToolbar()
    {
        $toolbar = new Tag("ul", array("class"=>"nav nav-pills"));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-file"></span>&nbsp;Crear', array("class"=>"btn btn-primary", "onclick"=>"createProvince();"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifiar', array("id"=>"updateButton", "class"=>"btn btn-primary", "onclick"=>"updateProvince();", "disabled"=>"true"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar', array("id"=>"deleteButton", "class"=>"btn btn-primary", "onclick"=>"deleteProvince();", "disabled"=>"true"))));
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
    
    protected function addScripts ()
    {
        parent::addScripts();
        $this->addScript ('
            function getSelectedProvinceId ()
            {
                var selectedRows = $("#provincesTable > tbody > tr.danger"); 
                return (selectedRows.length > 0)? selectedRows.first().attr("provinceId") : false;
            }
            
            function selectProvince (provinceId)
            {
                $("tr[provinceId=" + provinceId + "]").addClass("danger").siblings().removeClass("danger");
                $("#updateButton").prop("disabled",false); 
                $("#deleteButton").prop("disabled",false);
            }

            function createProvince ()
            {
                window.open("' . $this->getUrl("site/province/showProvinceForm") . '", "_self");
            }
            
            function updateProvince ()
            {
                var selectedProvinceId = getSelectedProvinceId();
                if (selectedProvinceId != false)
                    window.open("' . $this->getUrl("site/province/showProvinceForm") . '?provinceid=" + selectedProvinceId, "_self");
            }
            
            function deleteProvince ()
            {
                var selectedProvinceId = getSelectedProvinceId();
                if (selectedProvinceId != false)
                    if (window.confirm("Esta seguro de eliminar la categoría " + selectedProvinceId + " ?"))
                        window.open("' . $this->getUrl("site/province/deleteProvince") . '?provinceid=" + selectedProvinceId, "_self");
            }
        ');
        
        $this->addOnDocumentReadyScript('
            var tableRows = $("#provincesTable > tbody > tr");
            tableRows.on("click", function(event) { selectProvince($(this).attr("provinceId")); });
            tableRows.on("dblclick", function(event) { updateProvince(); });
        ');
    }
}

?>