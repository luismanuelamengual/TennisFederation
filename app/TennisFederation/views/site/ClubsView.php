<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\EntityTable;
use TennisFederation\views\site\SiteView;

class ClubsView extends SiteView
{
    private $clubs = array();
    
    public function setClubs ($clubs)
    {
        $this->clubs = $clubs;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), "Administración de Clubes"));
        $container->add ($this->createButtonToolbar());
        $container->add ($this->createClubsTable());
        return $container;
    }
    
    protected function createButtonToolbar()
    {
        $toolbar = new Tag("ul", array("class"=>"nav nav-pills"));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-file"></span>&nbsp;Crear', array("class"=>"btn btn-primary", "onclick"=>"createClub();"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifiar', array("id"=>"updateButton", "class"=>"btn btn-primary", "onclick"=>"updateClub();", "disabled"=>"true"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar', array("id"=>"deleteButton", "class"=>"btn btn-primary", "onclick"=>"deleteClub();", "disabled"=>"true"))));
        return $toolbar;
    }
    
    protected function createClubsTable()
    {
        $table = new EntityTable(array("id"=>"clubsTable"));
        $table->addColumn ("#", "id");
        $table->addColumn ("Nombre", "description");
        $table->setEntities($this->clubs);
        $table->addEntityProperty("clubId", "id");
        return $table;
    }
    
    protected function addScripts ()
    {
        parent::addScripts();
        $this->addScript ('
            function getSelectedClubId ()
            {
                var selectedRows = $("#clubsTable > tbody > tr.danger"); 
                return (selectedRows.length > 0)? selectedRows.first().attr("clubId") : false;
            }
            
            function selectClub (clubId)
            {
                $("tr[clubId=" + clubId + "]").addClass("danger").siblings().removeClass("danger");
                $("#updateButton").prop("disabled",false); 
                $("#deleteButton").prop("disabled",false);
            }

            function createClub ()
            {
                window.open("' . $this->getUrl("site/club/showClubForm") . '", "_self");
            }
            
            function updateClub ()
            {
                var selectedClubId = getSelectedClubId();
                if (selectedClubId != false)
                    window.open("' . $this->getUrl("site/club/showClubForm") . '?clubid=" + selectedClubId, "_self");
            }
            
            function deleteClub ()
            {
                var selectedClubId = getSelectedClubId();
                if (selectedClubId != false)
                    if (window.confirm("Esta seguro de eliminar la categoría " + selectedClubId + " ?"))
                        window.open("' . $this->getUrl("site/club/deleteClub") . '?clubid=" + selectedClubId, "_self");
            }
        ');
        
        $this->addOnDocumentReadyScript('
            var tableRows = $("#clubsTable > tbody > tr");
            tableRows.on("click", function(event) { selectClub($(this).attr("clubId")); });
            tableRows.on("dblclick", function(event) { updateClub(); });
        ');
    }
}

?>