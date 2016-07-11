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
        return $this->createTemplateView("site.clubs.list", ["clubs"=>$this->findModels(Club::class, [], ["id"])]);
    }
    
    public function showClubFormAction ($id = null)
    {
        return $this->createTemplateView("site.clubs.form", ["club"=> !empty($id)? $this->findModel(Club::class, $id) : null]);
    }
    
    public function createClubAction ()
    {
        $this->insertModel($this->createModel(Club::class, $this->getRequest()->getParameters()->get()));
        return new RedirectResponse($this->getUrl("club/showClubsList"));
    }
    
    public function updateClubAction ()
    {
        $this->updateModel($this->createModel(Club::class, $this->getRequest()->getParameters()->get()));
        return new RedirectResponse($this->getUrl("club/showClubsList"));
    }
    
    public function deleteClubAction ($id)
    {
        $this->removeModel(new Club($id));
        return new RedirectResponse($this->getUrl("club/showClubsList"));
    }
}