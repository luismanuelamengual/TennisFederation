<?php

namespace TennisFederation\controllers\site;

use TennisFederation\controllers\SiteController;

class TournamentController extends SiteController
{
    public function indexAction()
    {
        $this->showTournamentsListAction();
    }
    
    public function showTournamentsListAction ()
    {
        $tournaments = $this->getTournaments();        
        $tournamentsView = $this->createView("site/tournaments");
        $tournamentsView->setTournaments ($tournaments);
        $tournamentsView->render();
    }
    
    public function showADMTournamentsListAction ()
    {
        
    }
    
    public function showTournamentFormAction ($tournamentid)
    {
        $tournamentView = $this->createView("site/tournamentForm");
        $tournamentView->setCountries ($this->getApplication()->getController("site/country")->getCountries());
        $tournamentView->setProvinces ($this->getApplication()->getController("site/province")->getProvinces());
        $tournamentView->setClubs ($this->getApplication()->getController("site/club")->getClubs());
        if ($tournamentid != null)
            $tournamentView->setTournament($this->getCategory($tournamentid));
        $tournamentView->render();
    }
    
    public function getTournaments ()
    {
        $tournaments = array();
        $database = $this->getApplication()->getDefaultDatabase ();
        $doTournament = $database->getDataObject ("tournament");
        $doTournament->addOrderByField ("tournamentid");
        $doTournament->find();
        while ($doTournament->fetch())
        {
            $tournament = new Category();
            $tournament->completeFromFieldsArray($doTournament->getFields());
            $tournaments[] = $tournament;
        }
        return $tournaments;
    }
}

?>
