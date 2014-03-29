<?php

namespace TennisFederation\controllers\site;

use Exception;
use TennisFederation\controllers\SiteController;
use TennisFederation\models\Club;
use TennisFederation\models\UserType;

class ClubController extends SiteController
{
    public function onBeforeActionExecution ($action)
    {
        $executeAction = parent::onBeforeActionExecution($action);
        if ($executeAction && $this->getSession()->type != UserType::USERTYPE_ADMINISTRATOR)
            throw new Exception ("No tiene permisos para acceder a este controlador");
        return $executeAction;
    }
    
    public function indexAction()
    {
        $this->showClubListAction();
    }
    
    public function showClubListAction ()
    {
        $this->renderClubsView();
    }
    
    public function showClubFormAction($clubid=null)
    {
        $clubView = $this->createView("site/clubForm");
        if ($clubid != null)
            $clubView->setClub($this->getClub($clubid));
        $clubView->render();
    }
    
    public function createClubAction()
    {
        $club = new Club();
        $club->completeFromFieldsArray($this->getRequest()->getParameters()->getVars());
        $this->saveClub($club);
        $this->renderClubsView();
    }
    
    public function updateClubAction()
    {
        $club = new Club();
        $club->completeFromFieldsArray($this->getRequest()->getParameters()->getVars());
        $this->saveClub($club);
        $this->renderClubsView();
    }
    
    public function deleteClubAction($clubid)
    {
        $this->deleteClub($clubid);
        $this->renderClubsView();
    }
    
    private function renderClubsView ()
    {
        $clubs = $this->getClubs();        
        $clubView = $this->createView("site/clubs");
        $clubView->setClubs ($clubs);
        $clubView->render();
    }
    
    public function getClubs ()
    {
        $clubs = array();
        $database = $this->getApplication()->getDefaultDatabase ();
        $doClub = $database->getDataObject ("club");
        $doClub->addOrderByField ("clubid");
        $doClub->find();
        while ($doClub->fetch())
        {
            $club = new Club();
            $club->completeFromFieldsArray($doClub->getFields());
            $clubs[] = $club;
        }
        return $clubs;
    }
    
    public function getClub ($clubid)
    {
        $club = null;
        $database = $this->getApplication()->getDefaultDatabase ();
        $doClub = $database->getDataObject ("club");
        $doClub->addWhereCondition("clubid = " . $clubid);
        if ($doClub->find(true))
        {
            $club = new Club();
            $club->completeFromFieldsArray($doClub->getFields());
        }
        return $club;
    }
    
    public function saveClub (Club $club)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doClub = $database->getDataObject ("club");
        $doClub->description = $club->getDescription();
        $doClub->address = $club->getAddress();
        $doClub->contactvia1 = $club->getContactvia1();
        $doClub->contactvia2 = $club->getContactvia2();
        if ($club->getProvince() != null)
            $doClub->provinceid = $club->getProvince()->getId();
        if ($club->getId() != null)
        {
            $doClub->addWhereCondition("clubid = " . $club->getId());
            $doClub->update();
        }
        else
        {
            $doClub->insert();
        }
    }
    
    public function deleteClub ($clubid)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doClub = $database->getDataObject ("club");
        $doClub->addWhereCondition("clubid = " . $clubid);
        $doClub->delete();
    }
}

?>