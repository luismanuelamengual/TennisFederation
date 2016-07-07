<?php

namespace org\fmt\controller;

use NeoPHP\web\http\RedirectResponse;
use org\fmt\model\Club;

class ClubsController extends SiteController 
{   
    public function indexAction ()
    {
        return $this->showClubsListAction();
    }
    
    public function showClubsListAction ()
    {
        return $this->createTemplateView("site.clubs", ["clubs"=>$this->retrieveModels(Club::class, [], ["id"])]);
    }
    
    public function showClubFormAction ($id = null)
    {
        return $this->createTemplateView("site.clubForm", ["club"=> !empty($id)? $this->retrieveModel(Club::class, $id) : null]);
    }
    
    public function createClubAction ()
    {
        $club = new Club();
        $club->setFrom($this->getRequest()->getParameters()->get());
        $this->createModel($club);
        return new RedirectResponse($this->getUrl("club/showClubsList"));
    }
    
    public function updateClubAction ()
    {
        $club = new Club();
        $club->setFrom($this->getRequest()->getParameters()->get());
        $this->updateModel($club);
        return new RedirectResponse($this->getUrl("club/showClubsList"));
    }
    
    public function deleteClubAction ($id)
    {
        $club = new Club($id);
        $this->deleteModel($club);
        return new RedirectResponse($this->getUrl("club/showClubsList"));
    }
}