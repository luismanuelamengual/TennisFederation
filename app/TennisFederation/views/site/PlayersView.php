<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\EntityTable;
use TennisFederation\views\site\SiteView;

class PlayersView extends SiteView
{
    private $players = array();
    
    public function setPlayers ($players)
    {
        $this->players = $players;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), "Administración de Jugadores"));
        $container->add ($this->createButtonToolbar());
        $container->add ($this->createPlayersTable());
        return $container;
    }
    
    protected function createButtonToolbar()
    {
        $toolbar = new Tag("ul", array("class"=>"nav nav-pills"));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-file"></span>&nbsp;Crear', array("class"=>"btn btn-primary", "onclick"=>"createPlayer();"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifiar', array("id"=>"updateButton", "class"=>"btn btn-primary", "onclick"=>"updatePlayer();", "disabled"=>"true"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar', array("id"=>"deleteButton", "class"=>"btn btn-primary", "onclick"=>"deletePlayer();", "disabled"=>"true"))));
        return $toolbar;
    }
    
    protected function createPlayersTable()
    {
        $table = new EntityTable(array("id"=>"playersTable"));
        $table->addColumn ("#", "id");
        $table->addColumn ("Nombre", "firstname");
        $table->addColumn ("Apellido", "lastname");
        $table->addColumn ("EMail", "email");
        $table->addColumn ("Telefono 1", "contactVia1");
        $table->addColumn ("Telefono 2", "contactVia2");
        $table->setEntities($this->players);
        $table->addEntityProperty("playerId", "id");
        return $table;
    }
    
    protected function addScripts ()
    {
        parent::addScripts();
        $this->addScript ('
            function getSelectedPlayerId ()
            {
                var selectedRows = $("#playersTable > tbody > tr.danger"); 
                return (selectedRows.length > 0)? selectedRows.first().attr("playerId") : false;
            }
            
            function selectPlayer (playerId)
            {
                $("tr[playerId=" + playerId + "]").addClass("danger").siblings().removeClass("danger");
                $("#updateButton").prop("disabled",false); 
                $("#deleteButton").prop("disabled",false);
            }

            function createPlayer ()
            {
                window.open("' . $this->getUrl("site/player/showPlayerForm") . '", "_self");
            }
            
            function updatePlayer ()
            {
                var selectedPlayerId = getSelectedPlayerId();
                if (selectedPlayerId != false)
                    window.open("' . $this->getUrl("site/player/showPlayerForm") . '?playerid=" + selectedPlayerId, "_self");
            }
            
            function deletePlayer ()
            {
                var selectedPlayerId = getSelectedPlayerId();
                if (selectedPlayerId != false)
                    if (window.confirm("Esta seguro de eliminar la categoría " + selectedPlayerId + " ?"))
                        window.open("' . $this->getUrl("site/player/deletePlayer") . '?playerid=" + selectedPlayerId, "_self");
            }
        ');
        
        $this->addOnDocumentReadyScript('
            var tableRows = $("#playersTable > tbody > tr");
            tableRows.on("click", function(event) { selectPlayer($(this).attr("playerId")); });
            tableRows.on("dblclick", function(event) { updatePlayer(); });
        ');
    }
}

?>