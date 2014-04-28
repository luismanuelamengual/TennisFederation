<?php

namespace TennisFederation\controllers\site;

use Exception;
use TennisFederation\controllers\SiteController;
use TennisFederation\models\Tournament;
use TennisFederation\models\Category;

class TournamentController extends SiteController
{
    public function indexAction()
    {
        $this->showTournamentsListAction();
    }
    
    public function createTournamentAction()
    {
        $tournament = $this->createTournamentFromRequest();
        $this->saveTournament($tournament);
        $this->showTournamentsListAction();
    }
    
    public function updateTournamentAction()
    {
        $tournament = $this->createTournamentFromRequest();
        $this->saveTournament($tournament);
        $this->showTournamentsListAction();
    }
    
    public function deleteTournamentAction($tournamentid)
    {
        $this->deleteTournament($tournamentid);
        $this->showTournamentsListAction();
    }
    
    private function createTournamentFromRequest ()
    {
        $tournament = new Tournament();
        $tournament->completeFromFieldsArray($this->getRequest()->getParameters()->getVars());
        if (!empty($this->getRequest()->getParameters()->categories) && sizeof($this->getRequest()->getParameters()->categories) > 0)
        {
            foreach ($this->getRequest()->getParameters()->categories as $categoryId)
                $tournament->addCategory(new Category($categoryId));
        }
        return $tournament;
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
        $tournamentView->setCategories ($this->getApplication()->getController("site/category")->getCategories());
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
        $doClub = $database->getDataObject ("club");
        $doTournament->addSelectField ("tournament.*");
        $doTournament->addSelectFields (array("clubid","description"), "club_%s", "club");
        $doTournament->addJoin ($doClub);
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
        if ($tournament != null)
        {
            $doTournamentCategory = $database->getDataObject ("tournamentcategory");
            $doTournamentCategory->addWhereCondition("tournamentid = " . $tournamentid);
            $doTournamentCategory->find();
            while ($doTournamentCategory->fetch())
            {
                $tournament->addCategory(new Category($doTournamentCategory->categoryid));
            }
        }
        return $tournament;
    }
    
    public function saveTournament (Tournament $tournament)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $database->beginTransaction();
        try 
        {
            $doTournament = $database->getDataObject ("tournament");
            $doTournament->description = $tournament->getDescription();
            if ($tournament->getCountry() != null)
                $doTournament->countryid = $tournament->getCountry()->getId();
            if ($tournament->getProvince() != null)
                $doTournament->provinceid = $tournament->getProvince()->getId();
            if ($tournament->getClub() != null)
                $doTournament->clubid = $tournament->getClub()->getId();
            $doTournament->startdate = $tournament->getStartDate();
            $doTournament->inscriptionsdate = $tournament->getInscriptionsDate();
            $doTournament->state = !empty($tournament->getState())? $tournament->getState() : Tournament::STATE_INSCRIPTION;
            $tournamentId = $tournament->getId();
            if ($tournamentId != null)
            {
                $doTournament->addWhereCondition("tournamentid = " . $tournament->getId());
                $doTournament->update();
                $doTournamentCategory = $database->getDataObject ("tournamentcategory");
                $doTournamentCategory->addWhereCondition("tournamentid = " . $tournamentId);
                $doTournamentCategory->delete();
            }
            else
            {
                $doTournament->organizerid = ($tournament->getOrganizer() != null)? $tournament->getOrganizer()->getId() : $this->getSession()->userId;
                $doTournament->insert();
                $tournamentId = intval($database->getLastInsertedId("tournament_tournamentid_seq"));
                if (empty($tournamentId))
                    throw new Exception ("Id for new tournament could not be retrieved");
            }
            
            $categories = $tournament->getCategories();
            if (sizeof($categories) > 0)
            {
                $doTournamentCategory = $database->getDataObject ("tournamentcategory");
                $doTournamentCategory->tournamentid = $tournamentId;
                foreach ($categories as $category)
                {
                    $doTournamentCategory->categoryid = $category->getId();
                    $doTournamentCategory->insert();
                }
            }
            
            $database->commitTransaction();
        }
        catch (Exception $exception)
        {
            $database->rollbackTransaction();
            throw $exception;
        }
    }
    
    public function deleteTournament ($tournamentid)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doTournamentCategory = $database->getDataObject ("tournamentcategory");
        $doTournamentCategory->addWhereCondition("tournamentid = " . $tournamentid);
        $doTournamentCategory->delete();
        $doTournament = $database->getDataObject ("tournament");
        $doTournament->addWhereCondition("tournamentid = " . $tournamentid);
        $doTournament->delete();
    }
}

?>
