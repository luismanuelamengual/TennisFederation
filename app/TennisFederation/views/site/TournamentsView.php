<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\EntityTable;
use TennisFederation\views\site\SiteView;
use TennisFederation\models\Tournament;

class TournamentsView extends SiteView
{
    private $tournaments = array();
    
    public function setTournaments ($tournaments)
    {
        $this->tournaments = $tournaments;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), "Administración de Torneos"));
        $container->add ($this->createButtonToolbar());
        $container->add ($this->createTournamentsTable());
        return $container;
    }
    
    protected function createButtonToolbar()
    {
        $toolbar = new Tag("ul", array("class"=>"nav nav-pills"));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-file"></span>&nbsp;Crear', array("class"=>"btn btn-primary", "onclick"=>"createTournament();"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifiar', array("id"=>"updateButton", "class"=>"btn btn-primary", "onclick"=>"updateTournament();", "disabled"=>"true"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar', array("id"=>"deleteButton", "class"=>"btn btn-primary", "onclick"=>"deleteTournament();", "disabled"=>"true"))));
        return $toolbar;
    }
    
    protected function createTournamentsTable()
    {
        $table = new EntityTable(array("id"=>"tournamentsTable"));
        $table->addColumn ("#", "id");
        $table->addColumn ("Nombre", "description");
        $table->addColumn ("Club", "club_description");
        $table->addColumn ("Fecha inicia", "startDate");
        $table->addColumn ("Fecha cierre", "inscriptionsDate"); 
        $table->addColumn ("Estado", "state", function ($state) 
        {
            switch ($state)
            {
                case Tournament::STATE_INSCRIPTION: return "Inscripción"; break;
                case Tournament::STATE_PLAYING: return "En Juego"; break;
                case Tournament::STATE_FINALIZED: return "Finalizado"; break;
            }
        });
        $table->setEntities($this->tournaments);
        $table->addEntityProperty("tournamentId", "id");
        return $table;
    }
    
    protected function addScripts ()
    {
        parent::addScripts();
        $this->addScript ('
            function getSelectedTournamentId ()
            {
                var selectedRows = $("#tournamentsTable > tbody > tr.danger"); 
                return (selectedRows.length > 0)? selectedRows.first().attr("tournamentId") : false;
            }
            
            function selectTournament (tournamentId)
            {
                $("tr[tournamentId=" + tournamentId + "]").addClass("danger").siblings().removeClass("danger");
                $("#updateButton").prop("disabled",false); 
                $("#deleteButton").prop("disabled",false);
            }

            function createTournament ()
            {
                window.open("' . $this->getUrl("site/tournament/showTournamentForm") . '", "_self");
            }
            
            function updateTournament ()
            {
                var selectedTournamentId = getSelectedTournamentId();
                if (selectedTournamentId != false)
                    window.open("' . $this->getUrl("site/tournament/showTournamentForm") . '?tournamentid=" + selectedTournamentId, "_self");
            }
            
            function deleteTournament ()
            {
                var selectedTournamentId = getSelectedTournamentId();
                if (selectedTournamentId != false)
                    if (window.confirm("Esta seguro de eliminar el torneo " + selectedTournamentId + " ?"))
                        window.open("' . $this->getUrl("site/tournament/deleteTournament") . '?tournamentid=" + selectedTournamentId, "_self");
            }
        ');
        
        $this->addOnDocumentReadyScript('
            var tableRows = $("#tournamentsTable > tbody > tr");
            tableRows.on("click", function(event) { selectTournament($(this).attr("tournamentId")); });
            tableRows.on("dblclick", function(event) { updateTournament(); });
        ');
    }
}

?>