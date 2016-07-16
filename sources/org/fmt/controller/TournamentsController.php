<?php

namespace org\fmt\controller;

use NeoPHP\web\http\RedirectResponse;
use org\fmt\model\Tournament;

class TournamentsController extends SiteController 
{   
    public function indexAction ()
    {
        return $this->showTournamentsListAction();
    }
    
    public function showTournamentsListAction ()
    {
        return $this->createTemplateView("site.tournaments.list", ["tournaments"=>$this->findModels(Tournament::class, [], ["id"])]);
    }
    
    public function showTournamentFormAction ($id = null)
    {
        $parameters = [];
        $parameters["tournament"] = !empty($id)? $this->findModel(Tournament::class, $id) : null;
        $parameters["clubs"] = $this->findModels(\org\fmt\model\Club::class);
        return $this->createTemplateView("site.tournaments.form", $parameters);
    }
    
    public function createTournamentAction ()
    {
        $this->insertModel($this->createModel(Tournament::class, $this->getRequest()->getParameters()->get()));
        return new RedirectResponse($this->getUrl("club/showTournamentsList"));
    }
    
    public function updateTournamentAction ()
    {
        $this->updateModel($this->createModel(Tournament::class, $this->getRequest()->getParameters()->get()));
        return new RedirectResponse($this->getUrl("club/showTournamentsList"));
    }
    
    public function deleteTournamentAction ($id)
    {
        $this->removeModel(new Tournament($id));
        return new RedirectResponse($this->getUrl("club/showTournamentsList"));
    }
}