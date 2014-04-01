<?php

namespace TennisFederation\controllers\site;

use TennisFederation\controllers\SiteController;
use TennisFederation\models\Tournament;

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
            $tournamentView->setTournament($this->getTournament($tournamentid));
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
            $tournament = new Tournament();
            $tournament->completeFromFieldsArray($doTournament->getFields());
            $tournaments[] = $tournament;
        }
        return $tournaments;
    }
    
    public function getTournament ($tournamentid)
    {
        $tournament = null;
        $database = $this->getApplication()->getDefaultDatabase ();
        $doTournament = $database->getDataObject ("tournament");
        $doTournament->addWhereCondition("tournamentid = " . $tournamentid);
        if ($doTournament->find(true))
        {
            $tournament = new Tournament();
            $tournament->completeFromFieldsArray($doTournament->getFields());
        }
        return $tournament;
    }
    
    public function saveTournament (Tournament $tournament)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doTournament = $database->getDataObject ("tournament");
        $doTournament->description = $tournament->getDescription();
        if ($tournament->getCountry() != null)
            $doTournament->countryid = $tournament->getCountry()->getId();
        if ($tournament->getProvince() != null)
            $doTournament->provinceid = $tournament->getProvince()->getId();
        if ($tournament->getClub() != null)
            $doTournament->clubid = $tournament->getClub()->getId();
        $doTournament->startdate = $tournament->getStartDate();
        $doTournament->inscriptiondate = $tournament->getInscriptionDate();
        if ($tournament->getState() != null)
            $doTournament->tournamentstateid = $tournament->getState()->getId();
        if ($tournament->getId() != null)
        {
            $doTournament->addWhereCondition("tournamentid = " . $tournament->getId());
            $doTournament->update();
        }
        else
        {
            if ($tournament->getOrganizer() != null)
                $doTournament->organizerid = $tournament->getOrganizer()->getId();
            $doTournament->insert();
        }
    }
    
    public function deleteTournament ($tournamentid)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doTournament = $database->getDataObject ("tournament");
        $doTournament->addWhereCondition("tournamentid = " . $tournamentid);
        $doTournament->delete();
    }
}

?>
